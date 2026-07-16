<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $payments = Payment::with('booking.user', 'booking.room')->latest()->paginate(10);
        } else {
            $payments = Payment::with('booking.room')
                ->whereHas('booking', fn ($q) => $q->where('user_id', $request->user()->id))
                ->latest()->paginate(10);
        }

        return view('payments.index', compact('payments'));
    }

    public function create(Booking $booking)
    {
        return view('payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_month' => 'required|string|max:20',
            'proof' => 'required|image|max:2048',
        ]);

        $path = $request->file('proof')->store('payments', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->amount,
            'payment_month' => $request->payment_month,
            'proof' => $path,
            'status' => 'menunggu',
        ]);

        return redirect()->route('payments.index')->with('success', 'Bukti pembayaran berhasil diunggah, menunggu verifikasi.');
    }

    // Admin: verify payment
    public function verify(Request $request, Payment $payment)
    {
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:lunas,ditolak']);

        $payment->update(['status' => $request->status]);

        return back()->with('success', 'Status pembayaran diperbarui.');
    }
}
