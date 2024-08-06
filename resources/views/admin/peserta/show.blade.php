<x-app-layout>
    <div class="container d-flex justify-content-center">
        <div class="w-50">
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="bg-white card-header">View Peserta</div>
                <div class="card-body">
                    <x-auth-session-status class="mb-3" :status="session('status')" />
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
    
                    <form method="POST" action="{{ route('bprs.peserta.update',$peserta->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 form-group">
                            <label for="nama">{{ __('Nama') }}</label>
                            <input id="nama" type="text" placeholder="Nama Peserta" class="form-control mt-2 @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $peserta->nama) }}" readonly>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                            <input id="tempat_lahir" type="text" placeholder="Tempat Lahir" class="form-control mt-2 @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" readonly>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                            <div class="mt-2 input-group date d-flex align-items-center" id="datepicker">
                                <input id="tanggal_lahir" type="text" placeholder="Tanggal Lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir) }}" readonly>
                                <span class="input-group-append">
                                    <span class="bg-white input-group-text">
                                        <i class="bi bi-calendar3"></i>
                                    </span>
                                </span>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="umur">{{ __('Umur') }}</label>
                            <input id="umur" type="text" class="mt-2 form-control" name="umur" value="{{ old('umur', $peserta->umur) }}" readonly>
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="alamat">{{ __('Alamat') }}</label>
                            <textarea id="alamat" placeholder="Alamat Peserta" class="form-control mt-2 @error('alamat') is-invalid @enderror" name="alamat" readonly>{{ old('alamat', $peserta->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="gap-3 mt-4 form-group d-flex justify-content-end">
                            <a class="btn btn-secondary" href="{{ route('admin.peserta.index') }}">
                                {{ __('Tutup') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
