<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use App\Models\Journal;
use Illuminate\Http\Request;
use PDF;

class AdminReportController extends Controller
{
    public function index()
    {

        $adminReports = AdminReport::all();
        return view('admin_reports.index', compact('adminReports'));
    }

    public function markAsRead($id)
    {
        $adminReport = AdminReport::findOrFail($id);
        $adminReport->update(['read_by_admin' => true]);

        return redirect()->route('admin_reports.index')->with('success', 'Rapport marqué comme lu.');
    }

    public function exportReportToPDF($id)
    {
        $adminReport = AdminReport::findOrFail($id);
        $journals = Journal::whereDate('Date', $adminReport->date)->get();

        $pdf = PDF::loadView('admin_reports.pdf', compact('journals', 'adminReport'));

        return $pdf->download('admin_report_' . $adminReport->date . '.pdf');
    }
}
