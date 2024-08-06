<x-app-layout>
    <div class="container d-flex justify-content-center">
        <div class="w-50">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card ">
                <div class="bg-white card-header">Insert Peserta</div>
                <div class="card-body">
                    <x-auth-session-status class="mb-3" :status="session('status')" />
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
    
                    <form method="POST" action="{{ route('bprs.peserta.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="nama">{{ __('Nama') }}</label>
                            <input id="nama" type="text" placeholder="Nama Peserta" class="form-control mt-2 @error('nama') is-invalid @enderror" name="nama" :value="old('nama')" required autofocus>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                            <input id="tempat_lahir" type="text" placeholder="Tempat Lahir" class="form-control mt-2 @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" :value="old('tempat_lahir')" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                            <div class="mt-2 input-group date d-flex align-items-center" id="datepicker">
                                <input id="tanggal_lahir" type="text" placeholder="Tanggal Lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" :value="old('tanggal_lahir')" required>
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
                            <input id="umur" type="text" class="mt-2 form-control" name="umur" readonly>
                        </div>
    
                        <div class="mb-3 form-group">
                            <label for="alamat">{{ __('Alamat') }}</label>
                            <textarea id="alamat" placeholder="Alamat Peserta" class="form-control mt-2 @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
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
    $(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: 'today'
        }).on('changeDate', function (e) {
            const dob = new Date(e.date);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate()))   
 {
                age--;
            }

            $('#umur').val(age);
        });
    });
</script>
