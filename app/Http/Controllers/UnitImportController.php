<?php

namespace App\Http\Controllers;

use App\Imports\UnitsImport;
use App\Exports\UnitTemplateExport;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitImportController extends Controller
{
    // Show upload form
    public function create()
    {
        return view('units.import');
    }

    // Handle the upload
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $path = $request->file('file')->store('imports');

        $importer = new UnitsImport($request->user()->id);
        $importer->import(storage_path('app/' . $path));

        // Clean up the uploaded file
        Storage::delete($path);

        if (!$importer->imported) {
            return redirect()->back()
                ->with('import_errors', $importer->errors)
                ->with('error', 'Nothing was saved. Fix the errors below and try again.');
        }

        return redirect('/units')->with('success', "{$importer->imported} units imported successfully.");
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