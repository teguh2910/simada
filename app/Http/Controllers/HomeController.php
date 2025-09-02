<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Komentar;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\ReviseTransactionRequest;
use App\Http\Requests\FeedbackRequest;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(): \Illuminate\View\View
    {
        return view('create');
    }        
    public function create_store(CreateTransactionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $documentRanges = [
            'SPTT-1' => [[1, 7], [31, 32]],
            'SPTT-2' => [[8, 27]],
            'SPTT-3' => [[28, 30]],
        ];

        $ranges = $documentRanges[$request->kind_doc] ?? [];

        $transactions = [];
        foreach ($ranges as $range) {
            [$start, $end] = $range;
            for ($id = $start; $id <= $end; $id++) {
                $transactions[] = [
                    'project' => $validated['project'],
                    'due_date' => $validated['due_date'],
                    'supplier' => $validated['supplier'],
                    'part_number' => $validated['part_number'],
                    'status' => 0,
                    'id_document' => $id,
                    'revise' => 0,
                    'pic' => Auth::user()->name,
                    'npk' => Auth::user()->npk,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Transaction::insert($transactions);

        return redirect('/')->with(['success' => 'Sukses Simpan']);
    }
    public function index(): \Illuminate\View\View
    {
        $data = Transaction::with('document')
            ->whereNull('file')
            ->where('is_need', true)
            ->get();

        return view('home', compact('data'));
    }
    public function upload(int $id): \Illuminate\View\View
    {
        $doc = Transaction::with('document')
            ->where('id_transaction', $id)
            ->firstOrFail();

        return view('upload', compact('doc', 'id'));
    }
    public function upload_store(int $id, UploadFileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $transaction = Transaction::findOrFail($id);

        $filePath = $request->file('file')->storeAs(
            'uploads/' . $id,
            $validated['doc_file'] . '.' . $request->file('file')->extension(),
            'public'
        );

        $transaction->update(['file' => $filePath]);

        return redirect('/')->with(['success' => 'Sukses Simpan']);
    }
    public function draft(): \Illuminate\View\View
    {
        $data = Transaction::with('document')
            ->whereNotNull('file')
            ->where('status', 0)
            ->get();

        return view('draft', compact('data'));
    }
    public function revise(int $id): \Illuminate\View\View
    {
        $doc = Transaction::with('document')
            ->where('id_transaction', $id)
            ->firstOrFail();

        return view('revise', compact('doc', 'id'));
    }
    public function revise_store(int $id, ReviseTransactionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $filePath = $request->file('file')->storeAs(
            'uploads/' . $id,
            $validated['doc_file'] . '.pdf',
            'public'
        );

        Transaction::create([
            'project' => $validated['project'],
            'due_date' => $validated['due_date'],
            'supplier' => $validated['supplier'],
            'part_number' => $validated['part_number'],
            'status' => 0,
            'id_document' => $validated['id_document'],
            'revise' => $validated['revise'],
            'file' => $filePath,
            'pic' => Auth::user()->name,
            'npk' => Auth::user()->npk,
        ]);

        return redirect('/draft')->with(['success' => 'Sukses Simpan']);
    }
    public function feedback(int $id): \Illuminate\View\View
    {
        $doc = Transaction::findOrFail($id);

        return view('komentar', compact('doc', 'id'));
    }
    public function feedback_store(int $id, FeedbackRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        Komentar::create([
            'id_transactions' => $id,
            'pic_k' => Auth::user()->name,
            'npk_k' => Auth::user()->npk,
            'dep_k' => Auth::user()->dept,
            'komentar' => $validated['komentar'],
        ]);

        return redirect('/draft')->with(['success' => 'Sukses Simpan']);
    }
    public function viewfeedback(int $id): \Illuminate\View\View
    {
        $data = Transaction::with(['document', 'komentars'])
            ->where('id_transaction', $id)
            ->firstOrFail();

        return view('view_komentar', compact('data', 'id'));
    }
    public function final(int $id): \Illuminate\Http\RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 1]);

        return redirect('/draft')->with(['success' => 'Sukses Simpan']);
    }
    public function final_view(): \Illuminate\View\View
    {
        $data = Transaction::with(['document', 'komentars'])
            ->whereNotNull('file')
            ->where('status', 1)
            ->get();

        return view('final', compact('data'));
    }
    public function overdue(): \Illuminate\View\View
    {
        $data = Transaction::with(['document', 'komentars'])
            ->whereNull('file')
            ->where('is_need', true)
            ->whereDate('due_date', '<=', Carbon::today())
            ->get();

        return view('overdue', compact('data'));
    }
    public function del(int $id): \Illuminate\Http\RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect('/draft');
    }   
    public function noneed(int $id): \Illuminate\Http\RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['is_need' => false]);

        return redirect('/')->with(['success' => 'Sukses']);
    }
    public function dashboard(): \Illuminate\View\View
    {
        $outs = Transaction::whereNull('file')
            ->where('is_need', true)
            ->count();

        $draft = Transaction::whereNotNull('file')
            ->where('status', 0)
            ->count();

        $final = Transaction::whereNotNull('file')
            ->where('status', 1)
            ->count();

        $overd = Transaction::whereNull('file')
            ->where('is_need', true)
            ->whereDate('due_date', '<=', Carbon::today())
            ->count();

        // PCR & APR Statistics (placeholders - customize based on your data structure)
        $pcr_process = 0; // Replace with actual PCR process count
        $apr_process = 0; // Replace with actual APR process count
        $pcr_reports = 0; // Replace with actual PCR reports count
        $apr_reports = 0; // Replace with actual APR reports count

        return view('dashboard', compact('outs', 'draft', 'final', 'overd', 'pcr_process', 'apr_process', 'pcr_reports', 'apr_reports'));
    }
}
