@extends('layouts.app')

@section('title', 'Kirim Cucian Baru')

@push('styles')
    <style>
        /* Clean & Minimalist Style */
        .room-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .room-card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 8px 8px 0 0;
        }

        .no-room-input {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 6px 12px;
            font-weight: 600;
            color: #334155;
            width: 150px;
            outline: none;
        }

        .no-room-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(104, 97, 206, 0.2);
        }

        .qty-input {
            text-align: center;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            width: 80px;
            padding: 6px;
            color: #334155;
            outline: none;
        }

        .qty-input:focus {
            border-color: var(--primary-color);
        }

        .linen-row {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .linen-row:last-child {
            border-bottom: none;
        }

        .linen-name {
            flex: 1;
            color: #475569;
            font-weight: 500;
        }

        .linen-satuan {
            width: 60px;
            color: #94a3b8;
            font-size: 0.9rem;
            text-align: right;
        }

        .btn-add-room {
            background: #f8fafc;
            color: var(--primary-color);
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-add-room:hover {
            border-color: var(--primary-color);
            background: #f1f5f9;
        }
    </style>
@endpush

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Kirim Cucian Kotor</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-layer-group mr-2"></i> Masukkan data linen kotor per kamar hotel
                    </h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('hotel.dashboard') }}" class="btn btn-white btn-border btn-round shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Batal & Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('hotel.transactions.store') }}" method="POST" id="transaction-form">
                    @csrf

                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body d-flex justify-content-between align-items-center bg-white rounded">
                            <div>
                                <h6 class="mb-1 text-primary font-weight-bold"><i class="fas fa-bolt mr-1"></i> Sistem FCFS
                                    Aktif</h6>
                                <small class="text-muted">Waktu input dicatat otomatis. Masukkan data per kamar.</small>
                            </div>
                            <div class="text-right border-left pl-4">
                                <span class="d-block small text-muted font-weight-bold text-uppercase">Total
                                    Keseluruhan</span>
                                <h3 class="mb-0 font-weight-bold text-dark" id="grand-total-display">0 pcs</h3>
                            </div>
                        </div>
                    </div>

                    <div id="rooms-container"></div>

                    <button type="button" class="btn-add-room mb-4 shadow-sm" id="btn-add-room">
                        <i class="fas fa-plus mr-1"></i> Tambah Kamar Lain
                    </button>

                    <div class="d-flex justify-content-end bg-white p-3 rounded shadow-sm border-0">
                        <button type="submit" class="btn btn-primary btn-round px-5 font-weight-bold shadow-sm">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesanan
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h4 class="card-title text-dark"><i class="fas fa-info-circle text-primary mr-2"></i> Petunjuk</h4>
                    </div>
                    <div class="card-body text-muted small">
                        <ol class="pl-3 mb-0" style="line-height: 1.8;">
                            <li class="mb-2">Ketik <strong>Nomor Kamar</strong> pada kolom header abu-abu.</li>
                            <li class="mb-2">Isi angka jumlah linen kotor pada jenis barang yang sesuai.</li>
                            <li class="mb-2">Abaikan (biarkan 0) jika linen tersebut tidak diganti.</li>
                            <li>Klik <strong>Tambah Kamar Lain</strong> untuk memasukkan cucian dari kamar lain.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Ambil data linen dari controller
        const linens = @json($linens->map(fn($l) => ['linen_id' => $l->linen_id, 'nama_linen' => $l->nama_linen, 'satuan' => $l->satuan]));
        let roomCount = 0;

        // Fungsi membuat cetakan kotak kamar
        function buildRoomCard(roomIdx) {
            const card = document.createElement('div');
            card.className = 'room-card shadow-sm';
            card.id = `room-card-${roomIdx}`;

            let rowsHtml = '';
            linens.forEach((linen, linenIdx) => {
                rowsHtml += `
                <div class="linen-row">
                    <div class="linen-name"><i class="fas fa-caret-right text-muted mr-2" style="font-size: 10px;"></i>${linen.nama_linen}</div>
                    <input type="hidden" name="rooms[${roomIdx}][linens][${linenIdx}][linen_id]" value="${linen.linen_id}">
                    <input type="number" name="rooms[${roomIdx}][linens][${linenIdx}][qty]" class="qty-input linen-qty" min="0" value="0" onfocus="this.select()">
                    <div class="linen-satuan">${linen.satuan}</div>
                </div>
            `;
            });

            // Bagian header kartu kamar (TULISAN 'UTAMA' SUDAH DIHAPUS DISINI)
            card.innerHTML = `
            <div class="room-card-header">
                <div class="d-flex align-items-center">
                    <span class="mr-3 font-weight-bold text-dark"><i class="fas fa-door-open text-muted mr-1"></i> Kamar:</span>
                    <input type="text" name="rooms[${roomIdx}][no_room]" class="no-room-input" placeholder="Contoh: 101" required>
                </div>
                ${roomIdx > 0 ? `<button type="button" class="btn btn-sm btn-danger btn-round py-1 px-2" title="Hapus Kamar" onclick="removeRoom(${roomIdx})"><i class="fas fa-times"></i></button>` : ''}
            </div>
            <div>${rowsHtml}</div>
        `;

            // Event listener saat angka qty diubah untuk menghitung total
            card.querySelectorAll('.linen-qty').forEach(input => {
                input.addEventListener('input', updateTotals);
                input.addEventListener('change', function() {
                    if (this.value < 0 || this.value === "") this.value = 0;
                });
            });

            return card;
        }

        // Fungsi menambahkan kamar ke dalam container
        function addRoom() {
            document.getElementById('rooms-container').appendChild(buildRoomCard(roomCount++));
        }

        // Fungsi menghapus kamar
        function removeRoom(roomIdx) {
            const card = document.getElementById(`room-card-${roomIdx}`);
            if (card) {
                card.remove();
                updateTotals();
            }
        }

        // Fungsi update teks Grand Total
        function updateTotals() {
            let grandTotal = 0;
            document.querySelectorAll('.linen-qty').forEach(input => {
                grandTotal += parseInt(input.value) || 0;
            });
            document.getElementById('grand-total-display').textContent = `${grandTotal} pcs`;
        }

        // SAAT HALAMAN SELESAI DIMUAT:
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Munculkan 1 kamar pertama secara otomatis
            addRoom();

            // 2. Aktifkan tombol "Tambah Kamar Lain"
            document.getElementById('btn-add-room').addEventListener('click', addRoom);
        });

        // Validasi sebelum form dikirim
        document.getElementById('transaction-form').addEventListener('submit', function(e) {
            let grandTotal = 0;
            document.querySelectorAll('.linen-qty').forEach(input => {
                grandTotal += parseInt(input.value) || 0;
            });

            if (grandTotal === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kosong',
                    text: 'Harap masukkan minimal 1 item linen.',
                    confirmButtonColor: '#6861CE'
                });
            }
        });
    </script>
@endsection
