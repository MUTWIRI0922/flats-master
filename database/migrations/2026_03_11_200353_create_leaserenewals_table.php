<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaserenewals', function (Blueprint $table) {
            $table->id()-> primary()->autoIncrement();
            $table->foreignId('lease_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2);
            $table->date('renewal_date');
            $table->date('new_end_date');
            $table->string('receipt_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaserenewals');
    }
};
