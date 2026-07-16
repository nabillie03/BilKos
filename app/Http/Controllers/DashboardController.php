<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $data = [
                'totalRooms' => Room::count(),
                'roomsFilled' => Room::where('status', 'terisi')->count(),
                'roomsAvailable' => Room::where('status', 'tersedia')->count(),
                'pendingBookings' => Booking::where('status', 'pending')->count(),
                'monthlyIncome' => Payment::where('status', 'lunas')
                    ->whereMonth('created_at', now()->month)
                    ->sum('amount'),
                'openComplaints' => Complaint::where('status', '!=', 'selesai')->count(),
            ];

            return view('dashboard.admin', $data);
        }

        $data = [
            'myBookings' => Booking::where('user_id', $request->user()->id)->count(),
            'myPendingPayments' => Payment::whereHas('booking', fn ($q) => $q->where('user_id', $request->user()->id))
                ->where('status', 'menunggu')->count(),
            'myComplaints' => Complaint::where('user_id', $request->user()->id)->count(),
        ];

        return view('dashboard.penyewa', $data);
    }
}
