<?php

namespace App\Http\Controllers\BPRS;

use App\Http\Controllers\Controller;
use App\Models\DokumenPeserta;
use App\Models\Peserta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = 'Pending';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'pending');
            return $this->getPesertaByStatus($statusPeserta);
        }
        return view('bprs.peserta.index', compact('status'));
    }

    public function upload(Request $request)
    {
        $status = 'Dokumen Pending';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'pending');
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen);
        }
        return view('bprs.peserta.index', compact('status'));
    }

    public function terima(Request $request)
    {
        $status = 'Diterima';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'diterima');
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen, true);
        }
        return view('bprs.peserta.index', compact('status'));
    }

    public function tolak(Request $request)
    {
        $status = 'Ditolak';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'tolak');
            return $this->getPesertaByStatus($statusPeserta);
        }
        return view('bprs.peserta.index', compact('status'));
    }

    public function dokumenTolak(Request $request)
    {
        $status = 'Dokumen Ditolak';
        if ($request->ajax()) {
            $statusPeserta = $request->get('status_peserta', 'diterima');
            $statusDokumen = $request->get('status_dokumen', 'tolak');
            return $this->getPesertaByStatus($statusPeserta, $statusDokumen);
        }
        return view('bprs.peserta.index', compact('status'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bprs.peserta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|integer',
                'alamat' => 'required|string',
            ]);

            Peserta::create($data);
            return redirect()->route('bprs.peserta.create')->with('message', 'Data peserta berhasil disimpan.');
        } catch (Exception $e) {
            Log::error('Gagal menyimpan data peserta: ' . $e->getMessage());
            return redirect()->route('bprs.peserta.create')->with('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            return view('bprs.peserta.show', compact('peserta'));
        } catch (Exception $e) {
            Log::error('Gagal ambil data peserta: ' . $e->getMessage());
            return redirect()->route('bprs.peserta.index')->with('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            return view('bprs.peserta.edit', compact('peserta'));
        } catch (Exception $e) {
            Log::error('Gagal ambil data peserta: ' . $e->getMessage());
            return redirect()->route('bprs.peserta.index')->with('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|integer',
                'alamat' => 'required|string',
            ]);

            $peserta = Peserta::findOrFail($id);
            $peserta->update($request->all());

            return redirect()->route('bprs.peserta.index')->with('message', 'Data peserta berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Gagal update data peserta: ' . $e->getMessage());
            return redirect()->route('bprs.peserta.edit', $id)->with('error', 'Terjadi kesalahan saat update data peserta.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print(Request $request, $id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            return view('bprs.peserta.print', compact('peserta'));
        } catch (Exception $e) {
            Log::error('Gagal ambil data peserta: ' . $e->getMessage());
            return redirect()->route('bprs.peserta.index')->with('error', 'Terjadi kesalahan saat menyimpan data peserta.');
        }
    }

    public function dokumenUpload()
    {
        $pesertas = Peserta::where('status_peserta', 'diterima')
            ->where('status_dokumen', 'pending')
            ->whereDoesntHave('dokumenPesertas')
            ->get();

        return view('bprs.peserta.upload', compact('pesertas'));
    }

    public function dokumenStore(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required',
                'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'file_keterangan_sehat' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $pesertaId = $data['nama'];

            $fileKtpPath = $request->file('file_ktp')->store('uploads/ktp');
            $fileKkPath = $request->file('file_kk')->store('uploads/kk');
            $fileKeteranganSehatPath = $request->file('file_keterangan_sehat')->store('uploads/keterangan_sehat');

            DokumenPeserta::create([
                'id_peserta' => $pesertaId,
                'file_ktp' => $fileKtpPath,
                'file_kk' => $fileKkPath,
                'file_keterangan_sehat' => $fileKeteranganSehatPath,
            ]);

            return redirect()->route('bprs.peserta.upload')->with('message', 'Dokumen peserta berhasil diupload.');

        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . $e->getMessage(), [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Gagal upload dokumen peserta: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat upload dokumen peserta.');
        }
    }


    public function getPesertaByStatus($statusPeserta, $statusDokumen = 'pending',$print=false)
    {
        try {
            $query = Peserta::where('status_peserta', $statusPeserta)
                ->where('status_dokumen', $statusDokumen);

            return DataTables::of($query)
                ->addColumn('action', function ($query) use ($print){
                    if($print){
                        return '<div class="gap-1 d-flex align-items-center">'
                        . '<a href="' . route('bprs.peserta.show', $query->id) . '" class="btn btn-sm btn-info">View</a>'
                        . '<a href="' . route('bprs.peserta.print', $query->id) . '" target="_BLANK" class="btn btn-sm btn-warning">Print</a>'
                        . '</div>';
                    }else{
                        return '<div class="gap-1 d-flex align-items-center">'
                            . '<a href="' . route('bprs.peserta.show', $query->id) . '" class="btn btn-sm btn-info">View</a>'
                            . '<a href="' . route('bprs.peserta.edit', $query->id) . '" class="btn btn-sm btn-primary">Edit</a>'
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
