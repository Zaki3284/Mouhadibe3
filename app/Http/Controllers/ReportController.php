<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Report;
use App\Models\AdminReport;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function createReport(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:reports',
            'comments' => 'required',
        ]);

        Report::create([
            'date' => $request->date,
            'comments' => $request->comments,
        ]);

        // Create corresponding AdminReport
        AdminReport::create([
            'date' => $request->date,
            'comments' => $request->comments,
            'read_by_admin' => false,
        ]);

        return redirect()->route('reports.index')->with('success', 'Rapport créé avec succès.');
    }

    public function updateReport(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|unique:reports,date,' . $id,
            'comments' => 'required',
        ]);

        $report = Report::findOrFail($id);

        $report->update([
            'date' => $request->date,
            'comments' => $request->comments,
        ]);

        // Update corresponding AdminReport
        $adminReport = AdminReport::where('date', $report->date)->first();
        if ($adminReport) {
            $adminReport->update([
                'comments' => $request->comments,
            ]);
        }

        return redirect()->route('reports.index')->with('success', 'Rapport mis à jour avec succès.');
    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        // Delete corresponding AdminReport
        AdminReport::where('date', $report->date)->delete();

        return redirect()->route('reports.index')->with('success', 'Rapport supprimé avec succès.');
    }

    public function exportReportToPDF($id)
    {
        $report = Report::find($id);
        $journals = Journal::whereDate('Date', $report->date)->get();

        $pdf = PDF::loadView('reports.pdf', compact('journals', 'report'));

        return $pdf->download('rapport_' . $report->date . '.pdf');
    }
}
