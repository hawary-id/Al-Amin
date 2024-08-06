<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $status = 'Pending';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'pending');
            return $this->getPesertaByStatus($statusPeserta);
        }
        return view('admin.peserta.index', compact('status'));
    }

    public function show($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            return view('admin.peserta.show', compact('peserta'));
        } catch (Exception $e) {
            Log::error('Gagal ambil data peserta: ' . $e->getMessage());
            return redirect()->route('admin.peserta.index')->with('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }
    }

    public function upload(Request $request)
    {
        $status = 'Dokumen Pending';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'pending');
            $uploaded = true;
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen, $uploaded);
        }
        return view('admin.peserta.index', compact('status'));
    }

    public function terima(Request $request)
    {
        $status = 'Diterima';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'diterima');
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen, false, false);
        }
        return view('admin.peserta.index', compact('status'));
    }

    public function tolak(Request $request)
    {
        $status = 'Ditolak';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'tolak');
            return $this->getPesertaByStatus($statusPeserta,'pending',false,false);
        }
        return view('admin.peserta.index', compact('status'));
    }
    
    public function dokumenTolak(Request $request)
    {
        $status = 'Dokumen Ditolak';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'tolak');
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen,false,false);
        }
        return view('admin.peserta.index', compact('status'));
    }
    
    public function approvedPeserta(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'status_peserta' => 'diterima'
            ]);

            return redirect()->route('admin.peserta.index')->with('message', 'Status peserta berhasil di setujui.');
        } catch (Exception $e) {
            Log::error('Gagal update data peserta: ' . $e->getMessage());
            return redirect()->route('admin.peserta.index')->with('error', 'Terjadi kesalahan saat approve data peserta.');
        }
    }
    public function rejectedPeserta(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'status_peserta' => 'tolak'
            ]);

            return redirect()->route('admin.peserta.index')->with('message', 'Status peserta berhasil di tolak.');
        } catch (Exception $e) {
            Log::error('Gagal update data peserta: ' . $e->getMessage());
            return redirect()->route('admin.peserta.index')->with('error', 'Terjadi kesalahan saat tolak data peserta.');
        }
    }

    public function approvedDokumen(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'status_dokumen' => 'diterima'
            ]);

            return redirect()->route('admin.peserta.index')->with('message', 'Status dokumen berhasil di setujui.');
        } catch (Exception $e) {
            Log::error('Gagal update data peserta: ' . $e->getMessage());
            return redirect()->route('admin.peserta.index')->with('error', 'Terjadi kesalahan saat approve data peserta.');
        }
    }

    public function rejectedDokumen(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'status_dokumen' => 'tolak'
            ]);

            return redirect()->route('admin.peserta.index')->with('message', 'Status dokumen berhasil di setujui.');
        } catch (Exception $e) {
            Log::error('Gagal update data peserta: ' . $e->getMessage());
            return redirect()->route('admin.peserta.index')->with('error', 'Terjadi kesalahan saat approve data peserta.');
        }
    }
  
    public function getPesertaByStatus($statusPeserta, $statusDokumen = 'pending', $uploaded = false, $approval = true)
    {
        try {
            $query = Peserta::where('status_peserta', $statusPeserta)
                ->where('status_dokumen', $statusDokumen);

            if ($uploaded) {
                $query->whereHas('dokumenPesertas');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) use ($uploaded, $approval) {
                    $viewUrl = route('admin.peserta.show', $query->id);
                    $approveUrl = $uploaded ? route('admin.dokumen.approved', $query->id) : route('admin.peserta.approved', $query->id);
                    $rejectUrl = $uploaded ? route('admin.dokumen.rejected', $query->id) : route('admin.peserta.rejected', $query->id);

                    if ($approval) {
                        return '<div class="gap-1 d-flex align-items-center">'
                            . '<a href="' . $viewUrl . '" class="btn btn-sm btn-info">View</a>'
                            . '<a href="' . $approveUrl . '" class="btn btn-sm btn-primary">Approved</a>'
                            . '<a href="' . $rejectUrl . '" class="btn btn-sm btn-danger">Tolak</a>'
                            . '</div>';
                    } else {
                        return '<div class="gap-1 d-flex align-items-center">'
                            . '<a href="' . $viewUrl . '" class="btn btn-sm btn-info">View</a>'
                            . '</div>';
                    }
                })
                ->make(true);
        } catch (Exception $e) {
            Log::error('Gagal mengambil data peserta: ' . $e->getMessage());

            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data peserta.'], 500);
        }
    }
}
