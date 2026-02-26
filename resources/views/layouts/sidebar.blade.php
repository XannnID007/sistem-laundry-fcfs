<div class="sidebar sidebar-style-2" data-background-color="white">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-3 mt-1">
                    <img src="{{ asset('assets/img/avatar-2.png') }}" alt="image profile"
                        class="avatar-img rounded-circle border border-primary">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->username ?? 'Pengguna' }}
                            <span class="user-level text-primary">{{ ucfirst(Auth::user()->role ?? 'Guest') }}</span>
                        </span>
                    </a>
                </div>
            </div>

            <ul class="nav nav-secondary mt-2">

                {{-- ============================================ --}}
                {{-- MENU KHUSUS MANAJER --}}
                {{-- ============================================ --}}
                @if (Auth::user()->role == 'Manajer')
                    <li class="nav-item {{ Request::is('manajer/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('manajer.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Management</h4>
                    </li>

                    <li class="nav-item {{ Request::is('manajer/users*') ? 'active' : '' }}">
                        <a href="{{ route('manajer.users.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Kelola User</p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('manajer/hotels*') ? 'active' : '' }}">
                        <a href="{{ route('manajer.hotels.index') }}">
                            <i class="fas fa-building"></i>
                            <p>Kelola Hotel</p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('manajer/linens*') ? 'active' : '' }}">
                        <a href="{{ route('manajer.linens.index') }}">
                            <i class="fas fa-tshirt"></i>
                            <p>Jenis Linen</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Laporan</h4>
                    </li>

                    <li class="nav-item {{ Request::is('manajer/laporan*') ? 'active' : '' }}">
                        <a href="{{ route('manajer.laporan.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <p>Cetak Laporan</p>
                        </a>
                    </li>

                    {{-- ============================================ --}}
                    {{-- MENU KHUSUS PIHAK LAUNDRY --}}
                    {{-- ============================================ --}}
                @elseif(Auth::user()->role == 'Laundry')
                    <li class="nav-item {{ Request::is('laundry/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('laundry.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Operasional</h4>
                    </li>

                    <li class="nav-item {{ Request::is('laundry/queue*') ? 'active' : '' }}">
                        <a href="{{ route('laundry.queue.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Antrean Cucian</p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('laundry/transactions*') ? 'active' : '' }}">
                        <a href="{{ route('laundry.transactions.index') }}">
                            <i class="fas fa-history"></i>
                            <p>Riwayat Transaksi</p>
                        </a>
                    </li>

                    {{-- ============================================ --}}
                    {{-- MENU KHUSUS PIHAK HOTEL --}}
                    {{-- ============================================ --}}
                @elseif(Auth::user()->role == 'Hotel')
                    <li class="nav-item {{ Request::is('hotel/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('hotel.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Transaksi</h4>
                    </li>

                    <li class="nav-item {{ Request::is('hotel/transactions/create') ? 'active' : '' }}">
                        <a href="{{ route('hotel.transactions.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            <p>Kirim Cucian Baru</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ Request::is('hotel/transactions') && !Request::is('hotel/transactions/create') ? 'active' : '' }}">
                        <a href="{{ route('hotel.transactions.index') }}">
                            <i class="fas fa-list-alt"></i>
                            <p>Status Cucian</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
