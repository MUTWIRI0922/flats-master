<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantTest extends TestCase
{
    use RefreshDatabase;  // wipes DB after each test

    public function test_tenant_can_be_created(): void
    {
        // Create the owner first so foreign key constraint is satisfied
        $owner = User::factory()->create([
            'first_name' => 'Alice',
            'last_name'  => 'Smith',
            'email'      => 'alice@example.com',
            'phone'      => '1234567890',
            'password'   => bcrypt('password'),
        ]);

        // Create the tenant scoped to that owner
        $tenant = User::create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john.doe@example.com',
            'phone'      => '1234567890',
            'owner_id'   => $owner->id,
            'password'   => bcrypt('password'),
        ]);

        // Assert it was created correctly
        $this->assertInstanceOf(User::class, $tenant);
        $this->assertEquals('John',                  $tenant->first_name);
        $this->assertEquals('Doe',                   $tenant->last_name);
        $this->assertEquals('john.doe@example.com',  $tenant->email);
        $this->assertEquals('1234567890',             $tenant->phone);
        $this->assertEquals($owner->id,              $tenant->owner_id);

        // Assert it was actually saved to the database
        $this->assertDatabaseHas('users', [
            'email'    => 'john.doe@example.com',
            'owner_id' => $owner->id,
        ]);
    }

    public function test_tenant_belongs_to_owner(): void
    {
        $owner = User::factory()->create();

        $tenant = User::create([
            'first_name' => 'Jane',
            'last_name'  => 'Mwangi',
            'email'      => 'jane@example.com',
            'owner_id'   => $owner->id,
            'password'   => bcrypt('password'),
        ]);

        // Test the owner() relationship works
        $this->assertEquals($owner->id, $tenant->owner->id);
    }

    public function test_owner_can_see_their_tenants(): void
    {
        $owner = User::factory()->create();

        // Create 3 tenants under this owner
        User::factory()->count(3)->create([
            'owner_id' => $owner->id,
        ]);

        // Create a tenant under a different owner — should NOT appear
        $otherOwner = User::factory()->create();
        User::factory()->create([
            'owner_id' => $otherOwner->id,
        ]);

        // This owner should only see their 3 tenants
        $this->assertEquals(3, $owner->tenants()->count());
    }
}