<x-app-layout>
    <div class="container">
        <h1 class="mb-3 text-capitalize">Daftar Peserta {{ $status }}</h1>
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

        <div class="table-responsive">
            <table id="peserta-table" class="table pt-4 table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Durasi Asuransi</th>
                        <th>Tanggal Mulai Asuransi</th>
                        <th>Tanggal Selesai Asuransi</th>
                        <th>Status Peserta</th>
                        <th>Status Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        var baseUrl = window.location.href.split('?')[0];
        var hideActionColumn = baseUrl.endsWith('/peserta/status/upload');
        $('#peserta-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl,
                data: function (d) {
                }
            },
            columns: [
                { data: 'nama', name: 'nama' },
                { data: 'tempat_lahir', name: 'tempat_lahir' },
                { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                { data: 'umur', name: 'umur' },
                { data: 'alamat', name: 'alamat' },
                { data: 'durasi_asuransi', name: 'durasi_asuransi' },
                { data: 'tanggal_mulai_asuransi', name: 'tanggal_mulai_asuransi' },
                { data: 'tanggal_selesai_asuransi', name: 'tanggal_selesai_asuransi' },
                { data: 'status_peserta', name: 'status_peserta' },
                { data: 'status_dokumen', name: 'status_dokumen' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    visible: !hideActionColumn
                }
            ]
        });
    });
</script>
