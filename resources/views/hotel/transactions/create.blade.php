@extends('layouts.app')

@section('title', 'Kirim Cucian Baru')

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Kirim Cucian Kotor</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-layer-group mr-2"></i> Masukkan jumlah linen yang akan di-pickup oleh pihak laundry
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header pb-0 border-0 pt-4">
                        <h4 class="card-title fw-bold text-primary mb-0"><i class="fas fa-edit mr-2"></i>Form Input Cucian
                        </h4>
                    </div>

                    <form action="{{ route('hotel.transactions.store') }}" method="POST" id="transaction-form"
                        class="form-confirm">
                        @csrf
                        <div class="card-body">

                            <div class="alert shadow-sm border-left-primary bg-light mb-4" role="alert"
                                style="border-left: 4px solid var(--primary-color);">
                                <div class="d-flex align-items-center">
                                    <div class="icon mr-3 text-primary">
                                        <i class="fas fa-bolt fa-2x"></i>
                                    </div>
                                    <div>
                                        <strong class="text-primary">Sistem Antrean Prioritas (FCFS):</strong><br>
                                        <span class="text-muted">Waktu input Anda <b>tercatat otomatis</b> saat tombol
                                            "Kirim" ditekan. Pesanan akan diproses pihak laundry berdasarkan urutan pesanan
                                            masuk.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-white text-uppercase fw-bold" style="width: 50%;">Jenis Linen
                                            </th>
                                            <th class="text-white text-uppercase fw-bold text-center">Jumlah (Qty)</th>
                                            <th class="text-white text-uppercase fw-bold text-center" style="width: 20%;">
                                                Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($linens as $index => $linen)
                                            <tr>
                                                <td class="align-middle font-weight-bold text-dark pl-4"
                                                    style="font-size: 1.05rem;">
                                                    <i class="fas fa-tshirt text-muted mr-2"></i> {{ $linen->nama_linen }}
                                                </td>
                                                <td class="px-4">
                                                    <input type="hidden" name="linens[{{ $index }}][linen_id]"
                                                        value="{{ $linen->linen_id }}">
                                                    <div class="input-group input-group-lg">
                                                        <input type="number" name="linens[{{ $index }}][qty]"
                                                            min="0" value="0"
                                                            class="form-control text-center font-weight-bold border-primary shadow-sm"
                                                            placeholder="0"
                                                            style="font-size: 1.2rem; color: var(--primary-color);">
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-muted font-weight-bold">
                                                    {{ $linen->satuan }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @error('linens')
                                <div class="alert alert-danger mt-3 py-2">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="card-action text-right bg-light"
                            style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <a href="{{ route('hotel.dashboard') }}" class="btn btn-danger btn-round mr-2 shadow-sm">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-round shadow-sm px-4">
                                <i class="fas fa-paper-plane mr-2"></i> Simpan & Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-profile shadow-sm h-100" style="border-radius: 15px;">
                    <div class="card-header pb-5 bg-primary-gradient"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <div class="profile-picture pt-4">
                            <div class="avatar avatar-xl">
                                <span
                                    class="avatar-title rounded-circle border border-white bg-white text-primary shadow-sm"
                                    style="border-width: 3px !important;">
                                    <i class="fas fa-clipboard-check fa-3x"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-5">
                        <div class="user-profile text-center">
                            <div class="name fw-bold text-dark mt-2">Panduan Pengisian</div>
                            <div class="job text-muted">Ikuti 3 langkah mudah berikut:</div>

                            <div class="text-left mt-4 px-2">
                                <ul class="list-unstyled">
                                    <li class="mb-4 d-flex align-items-start">
                                        <div class="avatar avatar-sm mr-3 mt-1">
                                            <span
                                                class="avatar-title rounded-circle bg-light text-primary border border-primary"><i
                                                    class="fas fa-pen"></i></span>
                                        </div>
                                        <div class="text-muted" style="font-size: 0.95rem;">
                                            <strong class="text-dark d-block mb-1">Isi Jumlah Kolom</strong>
                                            Ketik angka pada jenis linen kotor yang ingin dicuci.
                                        </div>
                                    </li>

                                    <li class="mb-4 d-flex align-items-start">
                                        <div class="avatar avatar-sm mr-3 mt-1">
                                            <span
                                                class="avatar-title rounded-circle bg-light text-warning border border-warning"><i
                                                    class="fas fa-ban"></i></span>
                                        </div>
                                        <div class="text-muted" style="font-size: 0.95rem;">
                                            <strong class="text-dark d-block mb-1">Abaikan yang Kosong</strong>
                                            Biarkan angkanya <b>0</b> jika tidak ada linen jenis tersebut yang kotor hari
                                            ini.
                                        </div>
                                    </li>

                                    <li class="mb-2 d-flex align-items-start">
                                        <div class="avatar avatar-sm mr-3 mt-1">
                                            <span
                                                class="avatar-title rounded-circle bg-light text-success border border-success"><i
                                                    class="fas fa-check"></i></span>
                                        </div>
                                        <div class="text-muted" style="font-size: 0.95rem;">
                                            <strong class="text-dark d-block mb-1">Periksa Ulang</strong>
                                            Pastikan ada <b>minimal 1 barang</b> yang diinput sebelum menekan tombol Kirim.
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Validasi di sisi Client sebelum dikirim ke Server
            document.getElementById('transaction-form').addEventListener('submit', function(e) {
                const inputs = document.querySelectorAll('input[name*="[qty]"]');
                let hasQty = false;

                inputs.forEach(input => {
                    // Mengecek apakah ada setidaknya satu input yang nilainya lebih dari 0
                    if (parseInt(input.value) > 0) {
                        hasQty = true;
                    }
                });

                if (!hasQty) {
                    e.preventDefault(); // Menghentikan form agar tidak terkirim

                    // Notifikasi error yang sesuai dengan tema Royal Purple (bukan DarkRed)
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops! Form Kosong',
                        text: 'Anda belum memasukkan jumlah linen apa pun. Harap isi minimal satu jenis linen dengan jumlah lebih dari 0 sebelum mengirim pesanan.',
                        confirmButtonText: 'Baik, Saya Mengerti',
                        confirmButtonColor: 'var(--primary-color)',
                        backdrop: `rgba(104, 97, 206, 0.4)` // Latar belakang redup berwarna ungu
                    });
                }
            });
        </script>
    @endpush
@endsection
