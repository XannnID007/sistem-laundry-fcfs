@extends('layouts.app')

@section('title', 'Tambah User')

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('manajer.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item active">
        <a href="{{ route('manajer.users.index') }}">
            <i class="fas fa-users"></i>
            <p>Kelola User</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.hotels.index') }}">
            <i class="fas fa-building"></i>
            <p>Kelola Hotel</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.linens.index') }}">
            <i class="fas fa-tshirt"></i>
            <p>Kelola Jenis Linen</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.laporan.index') }}">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Tambah User Baru</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('manajer.users.index') }}">Kelola User</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Tambah User</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Data User</div>
                    </div>
                    <form action="{{ route('manajer.users.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group @error('username') has-error @enderror">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') }}" placeholder="Masukkan username..." required>
                                @error('username')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password..." required>
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('role') has-error @enderror">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control" id="role" name="role" required
                                    onchange="toggleHotelField()">
                                    <option value="">-- Pilih Hak Akses --</option>
                                    <option value="Manajer" {{ old('role') == 'Manajer' ? 'selected' : '' }}>Manajer
                                    </option>
                                    <option value="Hotel" {{ old('role') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Laundry" {{ old('role') == 'Laundry' ? 'selected' : '' }}>Laundry
                                    </option>
                                </select>
                                @error('role')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('hotel_id') has-error @enderror" id="hotel-field"
                                style="display: none;">
                                <label for="hotel_id">Pilih Hotel <span class="text-danger">*</span></label>
                                <select class="form-control" id="hotel_id" name="hotel_id">
                                    <option value="">-- Pilih Hotel --</option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->hotel_id }}"
                                            {{ old('hotel_id') == $hotel->hotel_id ? 'selected' : '' }}>
                                            {{ $hotel->nama_hotel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hotel_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-action text-right">
                            <a href="{{ route('manajer.users.index') }}" class="btn btn-danger btn-round mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-round">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleHotelField() {
                const role = document.getElementById('role').value;
                const hotelField = document.getElementById('hotel-field');
                const hotelSelect = document.getElementById('hotel_id');

                if (role === 'Hotel') {
                    hotelField.style.display = 'block';
                    hotelSelect.required = true;
                } else {
                    hotelField.style.display = 'none';
                    hotelSelect.required = false;
                    hotelSelect.value = '';
                }
            }
            document.addEventListener('DOMContentLoaded', toggleHotelField);
        </script>
    @endpush
@endsection
