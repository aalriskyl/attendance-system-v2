<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Middleware is now applied in routes/web.php

    public function index()
    {
        if (Auth::user()->role === 'super_admin') {
            $attendances = Attendance::with('user')->latest()->get();
        } else {
            $attendances = Auth::user()->attendances()->latest()->get();
        }

        return view('attendances.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'nullable|string|max:255',
        ]);

        Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'note' => $request->note,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Check-in successful!');
    }
}
