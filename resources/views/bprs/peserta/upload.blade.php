<x-app-layout>
    <div class="container d-flex justify-content-center">
        <div class="w-50">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card ">
                <div class="bg-white card-header">Upload Dokumen Peserta</div>
                <div class="card-body">
                    <x-auth-session-status class="mb-3" :status="session('status')" />
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
    
                    <form method="POST" action="{{ route('bprs.dokumen.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="nama">{{ __('Pilih Nama') }}</label>
                            <select id="nama" name="nama" class="form-control mt-2 @error('nama') is-invalid @enderror">
                                <option value="">-Pilih Peserta-</option>
                                @foreach ($pesertas as $peserta)
                                    <option value="{{ $peserta->id }}" data-info='@json($peserta)'>{{ $peserta->nama }}</option>
                                @endforeach
                            </select>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
    
                        <div class="mb-3 form-group">
                            <label for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                            <input id="tempat_lahir" type="text" placeholder="Tempat Lahir" class="form-control mt-2 @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" readonly>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-group">
                            <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                            <input id="tanggal_lahir" type="text" placeholder="Tanggal Lahir" class="form-control mt-2 @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" readonly>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-group">
                            <label for="umur">{{ __('Umur') }}</label>
                            <input id="umur" type="text" placeholder="Umur" class="form-control mt-2 @error('umur') is-invalid @enderror" name="umur" value="{{ old('umur') }}" readonly>
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
    
                        <div class="mb-3 form-group">
                            <label for="alamat">{{ __('Alamat') }}</label>
                            <textarea id="alamat" placeholder="Alamat Peserta" class="form-control mt-2 @error('alamat') is-invalid @enderror" name="alamat" readonly>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="file_ktp">{{ __('Upload KTP') }}</label>
                            <input id="file_ktp" type="file" placeholder="Tempat Lahir" class="form-control mt-2 @error('file_ktp') is-invalid @enderror" name="file_ktp" :value="old('file_ktp')" required>
                            @error('file_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="file_kk">{{ __('Upload KK') }}</label>
                            <input id="file_kk" type="file" placeholder="Tempat Lahir" class="form-control mt-2 @error('file_kk') is-invalid @enderror" name="file_kk" :value="old('file_kk')" required>
                            @error('file_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="file_keterangan_sehat">{{ __('Upload Keterangan Sehat') }}</label>
                            <input id="file_keterangan_sehat" type="file" placeholder="Tempat Lahir" class="form-control mt-2 @error('file_keterangan_sehat') is-invalid @enderror" name="file_keterangan_sehat" :value="old('file_keterangan_sehat')" required>
                            @error('file_keterangan_sehat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
    
                        <div class="gap-3 mt-4 form-group d-flex justify-content-end">
                            <a class="btn btn-secondary" href="{{ route('bprs.peserta.index') }}">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#nama').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var pesertaInfo = selectedOption.data('info');

            if (pesertaInfo) {
                $('#tempat_lahir').val(pesertaInfo.tempat_lahir);
                $('#tanggal_lahir').val(pesertaInfo.tanggal_lahir);
                $('#umur').val(pesertaInfo.umur);
                $('#alamat').val(pesertaInfo.alamat);
            } else {
                $('#tempat_lahir').val('');
                $('#tanggal_lahir').val('');
                $('#umur').val('');
                $('#alamat').val('');
            }
        });
    });
</script>