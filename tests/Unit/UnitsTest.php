<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitsTest extends TestCase
{
    use RefreshDatabase;

    public function test_unit_can_be_created(): void
    {
        $owner = User::factory()->create();

        $property = Property::factory()->create([
            'owner_id' => $owner->id,
        ]);

        $unit = Unit::create([
            'property_id' => $property->id,
            'unit_number'        => 'Unit 101',
            'unit_class'         => 'A',
            'rent_amount'        => 1200.00,
            'status'      => 'available',
        ]);

        $this->assertInstanceOf(Unit::class, $unit);
        $this->assertEquals($property->id, $unit->property_id);
        $this->assertEquals('Unit 101', $unit->unit_number);
        $this->assertEquals(1200.00, $unit->rent_amount);
        $this->assertEquals('available', $unit->status);

        $this->assertDatabaseHas('units', [
            'unit_number' => 'Unit 101',
            'rent_amount' => 1200.00,
        ]);
    }
    public function test_unit_can_be_updated(): void
    {
        $owner = User::factory()->create();

        $property = Property::factory()->create([
            'owner_id' => $owner->id,
        ]);

        $unit = Unit::factory()->create([
            'property_id' => $property->id,
            'unit_number' => 'Unit 101',
            'rent_amount' => 1200.00,
            'status'      => 'available',
        ]);

        $unit->update([
            'rent_amount' => 1300.00,
            'status'      => 'occupied',
        ]);

        $this->assertEquals(1300.00, $unit->rent_amount);
        $this->assertEquals('occupied', $unit->status);

        $this->assertDatabaseHas('units', [
            'id'          => $unit->id,
            'rent_amount' => 1300.00,
            'status'      => 'occupied',
        ]);
    }
    public function test_unit_can_be_deleted(): void
    {
        $owner = User::factory()->create();
        $property = Property::factory()->create([
            'owner_id' => $owner->id,
        ]);
        $unit = Unit::factory()->create([
            'property_id' => $property->id,
            'unit_number' => 'Unit 101',
            'rent_amount' => 1200.00,
            'status'      => 'available',
        ]);
        $unit->delete();
        $this->assertDatabaseMissing('units', [
            'id' => $unit->id,
        ]);
    }
    public function test_unit_can_be_found_by_property(): void
    {
        $owner = User::factory()->create();
        $property = Property::factory()->create([
            'owner_id' => $owner->id,
        ]);
        $unit = Unit::factory()->create([
            'property_id' => $property->id,
            'unit_number' => 'Unit 101',
            'rent_amount' => 1200.00,
            'status'      => 'available',
        ]);

        $units = Unit::where('property_id', $property->id)->get();

        $this->assertCount(1, $units);
        $this->assertTrue($units->contains($unit));
    }
}