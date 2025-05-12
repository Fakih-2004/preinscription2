<?php
namespace App\Http\Controllers;
use App\Exports\CandidatsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($formationId)
    {
        return Excel::download(new CandidatsExport($formationId), 'candidats_export.xlsx');
    }
}
