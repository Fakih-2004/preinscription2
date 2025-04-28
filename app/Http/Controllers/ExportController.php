<?php

namespace App\Http\Controllers;

use App\Exports\CandidatsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $formationId = $request->input('formation_id');
        return Excel::download(new CandidatsExport($formationId), 'candidats.xlsx');
    }
}
