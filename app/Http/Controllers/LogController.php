<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::select('text', 'created_at')->filter()->orderBy('created_at', 'desc')->paginate(25);

        return view('logs.index', compact('logs'));
    }

    public function fetch()
    {
        $logs = Log::orderBy('created_at', 'desc')->take(10)->get();

        $logs = $logs->map(function ($log) {
            return [
                'message' => $log->text,
                'timestamp' => $log->created_at->diffForHumans(),
            ];
        });

        return response()->json(['logs' => $logs]);
    }

    public function export(Request $request)
    {
        $filters = $request->all();
        return Excel::download(new LogsExport($filters), 'Logs.xlsx');
    }
}
