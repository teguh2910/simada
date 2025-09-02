<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\RFQ;
use App\Models\Supplier;
use App\Http\Requests\CreateRFQRequest;
use App\Http\Requests\SelectSuppliersRequest;
use App\Http\Requests\UpdateRFQRequest;
use App\Mail\RFQMail;

class RFQController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rfqs = RFQ::with('creator', 'suppliers')
            ->where('created_by', Auth::id())
            ->latest()
            ->paginate(10);

        return view('rfq.index', compact('rfqs'));
    }

    public function create()
    {
        return view('rfq.create');
    }

    public function store(CreateRFQRequest $request)
    {
        $rfq = RFQ::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'project' => $request->project,
            'part_number' => $request->part_number,
            'created_by' => Auth::id(),
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            $rfq->storeAttachments($request->file('attachments'));
        }

        return redirect()->route('rfq.select-suppliers', $rfq);
    }

    public function selectSuppliers(RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        $suppliers = Supplier::where('is_active', true)->get();

        return view('rfq.select-suppliers', compact('rfq', 'suppliers'));
    }

    public function storeSuppliers(SelectSuppliersRequest $request, RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        // Attach suppliers to RFQ (sync to replace existing relationships)
        $rfq->suppliers()->sync($request->suppliers);

        // Send emails to suppliers
        $this->sendRFQEmails($rfq);

        // Update RFQ status
        $rfq->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return redirect()->route('rfq.index')->with('success', 'RFQ sent to suppliers successfully!');
    }

    private function sendRFQEmails(RFQ $rfq)
    {
        foreach ($rfq->suppliers as $supplier) {
            Mail::to($supplier->email)->send(new RFQMail($rfq, $supplier));
        }
    }

    public function show(RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        $rfq->load('suppliers', 'creator');

        return view('rfq.show', compact('rfq'));
    }

    public function edit(RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        // Only allow editing of draft RFQs
        if ($rfq->status !== 'draft') {
            return redirect()->route('rfq.index')->with('error', 'Only draft RFQs can be edited.');
        }

        $rfq->load('suppliers');

        return view('rfq.edit', compact('rfq'));
    }

    public function update(UpdateRFQRequest $request, RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        // Only allow updating of draft RFQs
        if ($rfq->status !== 'draft') {
            return redirect()->route('rfq.index')->with('error', 'Only draft RFQs can be updated.');
        }

        $rfq->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'project' => $request->project,
            'part_number' => $request->part_number,
        ]);

        // Handle file uploads if provided
        if ($request->hasFile('attachments')) {
            $rfq->storeAttachments($request->file('attachments'));
        }

        // Update suppliers if provided
        if ($request->has('suppliers')) {
            $rfq->suppliers()->sync($request->suppliers);
        }

        // Send email if requested and suppliers are selected
        if ($request->send_email && $rfq->suppliers->count() > 0) {
            $this->sendRFQEmails($rfq);
            $rfq->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        }

        $message = $request->send_email && $rfq->suppliers->count() > 0
            ? 'RFQ updated and sent to suppliers successfully!'
            : 'RFQ updated successfully!';

        return redirect()->route('rfq.index')->with('success', $message);
    }

    public function destroy(RFQ $rfq)
    {
        // Ensure user owns this RFQ
        if ($rfq->created_by !== Auth::id()) {
            abort(403);
        }

        // Only allow deletion of draft RFQs
        if ($rfq->status !== 'draft') {
            return redirect()->route('rfq.index')->with('error', 'Only draft RFQs can be deleted.');
        }

        $rfq->delete();

        return redirect()->route('rfq.index')->with('success', 'RFQ deleted successfully!');
    }
}
