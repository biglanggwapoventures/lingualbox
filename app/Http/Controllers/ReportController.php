<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;


class ReportController extends Controller
{
    function show()
    {
        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $hired = DB::table('hired_status')->select(DB::raw('COUNT(id) AS x, DATE_FORMAT(hired_at, "%b") AS y'))
            ->where('status', '!=', 'FAILED')
            // ->where(DB::raw('YEAR(DATE(hired_at)) = YEAR(CURDATE())'))
            ->groupBy(DB::raw('MONTH(hired_at)'))
            ->pluck('x', 'y');

        $failed = DB::table('hired_status')->select(DB::raw('COUNT(id) AS x, DATE_FORMAT(failed_at, "%b") AS y'))
            ->where('status', '=', 'FAILED')
            // ->where(DB::raw('YEAR(failed_at) = YEAR(CURDATE())'))
            ->groupBy(DB::raw('MONTH(failed_at)'))
            ->pluck('x', 'y');

        $registered = DB::table('users')->select(DB::raw('COUNT(id) AS x, DATE_FORMAT(created_at, "%b") AS y'))
            ->where('account_type', '=', 'TEACHER')
            // ->where(DB::raw('YEAR(failed_at) = YEAR(CURDATE())'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('x', 'y');

        $report = ['hired' => [], 'failed' => []];
        foreach($months AS $m){
            $report['hired'][] = isset($hired[$m]) ? $hired[$m] : 0;
            $report['failed'][] = isset($failed[$m]) ? $failed[$m] : 0;
            $report['registered'][] = isset($registered[$m]) ? $registered[$m] : 0;
        }
        

        return view('blocks.reports.summary', compact('report'));
    }
}
