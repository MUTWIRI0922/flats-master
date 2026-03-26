<?php

namespace App\Imports;

use App\Models\Unit;
use App\Models\Property;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

class UnitsImport
{
    private int $propertyId;
    public array $errors = [];
    public int $imported = 0;

    public function __construct(int $propertyId)
    {
        $this->propertyId = $propertyId;
    }

    public function import(string $filePath): bool
    {
        $rows = (new FastExcel)->import($filePath);

        // Check file is not empty
        if ($rows->isEmpty()) {
            $this->errors[] = "The file is empty or has no valid rows.";
            return false;
        }

        // ── Step 1: Validate ALL rows first ───────────────────────────────
        foreach ($rows as $index => $row) {
            $this->validateRow($row, $index + 2);
        }

        // ── Step 2: If ANY row failed, stop — save nothing ────────────────
        if (!empty($this->errors)) {
            return false;
        }

        // ── Step 3: All rows valid — save everything in one transaction ───
        DB::transaction(function () use ($rows) {
            $property = Property::find($this->propertyId);

            foreach ($rows as $row) {
                Unit::create([
                    'property_id' => $property->id,
                    'unit_number' => trim($row['unit_number']),
                    'rent_amount' => $row['rent_amount'],
                    'unit_class'  => trim($row['unit_class']),
                    'status'      => 'available',
                ]);

                $this->imported++;
            }
        });

        return true;
    }

    // ── Validates a single row, pushes to $this->errors if invalid ────────
    private function validateRow(array $row, int $rowNumber): void
    {
        // unit_number
        if (empty($row['unit_number'])) {
            $this->errors[] = "Row {$rowNumber}: unit_number is required.";
        }

        // rent_amount
        if (empty($row['rent_amount'])) {
            $this->errors[] = "Row {$rowNumber}: rent_amount is required.";
        } elseif (!is_numeric($row['rent_amount'])) {
            $this->errors[] = "Row {$rowNumber}: rent_amount must be a valid number, got '{$row['rent_amount']}'.";
        } elseif ($row['rent_amount'] <= 0) {
            $this->errors[] = "Row {$rowNumber}: rent_amount must be greater than 0.";
        }

        // unit_class
        if (empty($row['unit_class'])) {
            $this->errors[] = "Row {$rowNumber}: unit_class is required.";
        }
    }
}