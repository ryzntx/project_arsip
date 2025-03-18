<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yungts97\LaravelUserActivityLog\Models\Log;

class LogAktivitas extends Controller
{
    public function index()
    {
        $logs = Log::with('user')->paginate(10);
        // dd($logs);
        $users = User::all();
        return view('admin.log_aktivitas.index', compact('logs', 'users'));
    }
}
