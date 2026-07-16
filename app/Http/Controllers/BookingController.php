<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $bookings = Booking::with(['user', 'room'])->latest()->paginate(10);
        } else {
            $bookings = Booking::with('room')
                ->where('user_id', $request->user()->id)
                ->latest()->paginate(10);
        }

        return view('bookings.index', compact('bookings'));
    }

    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(StoreBookingRequest $request)
    {
        Booking::create([
            'user_id' => $request->user()->id,
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diajukan, menunggu verifikasi admin.');
    }

    // Admin: approve booking
    public function approve(Booking $booking)
    {
        $this->authorizeAdmin();

        $booking->update(['status' => 'approved']);
        $booking->room()->update(['status' => 'terisi']);

        return back()->with('success', 'Booking disetujui.');
    }

    // Admin: reject booking
    public function reject(Booking $booking)
    {
        $this->authorizeAdmin();

        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking ditolak.');
    }

    private function authorizeAdmin()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
    }
}
