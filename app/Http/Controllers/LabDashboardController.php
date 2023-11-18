<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;


class LabDashboardController extends Controller
{
    public function dashboard()
    {
        $totalReports = Report::count();
        $countInProcessReports = Report::where('status', 'In Process')->count();
        $countUploadedReports = Report::where('status', 'Uploaded')->count();
    
        // Fetch aggregated data for reports performed each day with Uploaded status
        $uploadedReportsData = Report::select(DB::raw('DATE(updated_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('status', 'Uploaded')
            ->groupBy('date')
            ->orderBy('date', 'desc') // Order the data by date in descending order
            ->get();
    
        return view('labassistant.dashboard', compact('totalReports', 'countInProcessReports', 'countUploadedReports', 'uploadedReportsData'));
    }
    
    

}