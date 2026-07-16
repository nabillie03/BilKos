<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $complaints = Complaint::with('user', 'room')->latest()->paginate(10);
        } else {
            $complaints = Complaint::with('room')
                ->where('user_id', $request->user()->id)
                ->latest()->paginate(10);
        }

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => $request->user()->id,
            'room_id' => $request->room_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect()->route('complaints.index')->with('success', 'Komplain berhasil diajukan.');
    }

    // Admin: update status
    public function updateStatus(Request $request, Complaint $complaint)
    {
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:open,diproses,selesai']);

        $complaint->update(['status' => $request->status]);

        return back()->with('success', 'Status komplain diperbarui.');
    }
}
