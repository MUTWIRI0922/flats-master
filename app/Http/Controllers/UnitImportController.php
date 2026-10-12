<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Unit;
use App\Imports\UnitsImport;
use App\Exports\UnitTemplateExport;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitImportController extends Controller
{

    // Handle the upload
    public function store(Request $request, string $propertyId)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);
        $property = Property::findOrFail($propertyId); // Ensure the property exists
        $path = $request->file('excel_file')->store('imports');

        $importer = new UnitsImport($propertyId);
        $importer->import(Storage::path($path));

        // Clean up the uploaded file
        Storage::delete($path);

        if (!$importer->imported) {
            return redirect()->back()
                ->with('import_errors', $importer->errors)
                ->with('error', 'Nothing was saved. Fix the errors below and try again.');
        }
        //get the units for the property
        $units = Unit::where('property_id', $propertyId)->paginate(10);
        return view('user.properties.units', compact('property', 'units'))->with('success', "{$importer->imported} units imported successfully.");
    }

    // Download sample template
    public function template()
    {
        $data = collect([
            [

                'unit_number'   => 'A1',
                'unit_class'    => 'Single',
                'rent_amount'   => 1500,
            ],
            [
                'unit_number'   => 'A2',
                'unit_class'    => 'Bedsitter',
                'rent_amount'   => 12000,
            ],
        ]);

        return (new FastExcel($data))->download('units_template.xlsx');
    }
}