<?php
namespace App\Http\Controllers;
use DB;
use PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ViewController extends Controller
{
    public function index(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post'))
        {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search'))
            {
                // select search
                $search = DB::select("SELECT * FROM users WHERE email_verified_at BETWEEN '$from' AND '$to'");
                return view('import',['ViewsPage' => $search]);
            } 
            elseif ($req->has('exportPDF'))
            {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM users WHERE email_verified_at BETWEEN '$from' AND '$to'");
                $pdf = PDF::loadView('PDF_report', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF-report.pdf');
            }  
        }
            else
        {
            //select all
            $ViewsPage = DB::select('SELECT * FROM users');
            return view('import',['ViewsPage' => $ViewsPage]);
        }
    }
}