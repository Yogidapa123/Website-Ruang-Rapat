@extends('layouts.main')

@section('container')

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="blog" class="blog-area pt-170 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ $title }} </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Pemberitahuan dari admin akan muncul di daftar
                            peminjaman ini. Silahkan tunggu sampai dapat persetujuan dari admin.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-10 p-0">
                    <div class="card-body text-end">
                        @if (session()->has('rentSuccess'))
                            <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                                style="margin-top: 50px" role="alert">
                                {{ session('rentSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end">
                                {{ $userRents->links() }}
                            </div>

                            <table class="table table-striped table-bordered text-center">
                                <table class="table table-bordered table-striped text-center" style="background-color: red; color: white;">

                                <thead>
                                    <tr>
                                        <th scope="row">No.</th>
                                        <th scope="row">Nama Ruangan</th>
                                        <th scope="row">Bidang Peminjam</th>
                                        <th scope="row">Tanggal</th>
                                        <th scope="row">Mulai Pinjam</th>
                                        <th scope="row">Selesai Pinjam</th>
                                        <th scope="row">Kegiatan</th>
                                        <th scope="row">Waktu Peminjaman</th>
                                        <th scope="row">Status Pinjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody class="bg-white text-black">

                                    @if ($userRents->count() > 0)
                                        @foreach ($userRents as $rent)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th scope="row">
                                                @if($rent->room)
                                                <td><a href="/showruang/{{ $rent->room->name }}"
                                                        class="text-decoration-none"
                                                        role="button">{{ $rent->room->name }}</a>
                                                </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if (auth()->user()->role_id <= 2)
                                                    <td>{{ $rent->user->name ?? '' }}</td>
                                                @endif
                                                <td>{{ \Carbon\Carbon::parse ($rent->time_start_use)->format('d F Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse ($rent->time_start_use)->format('h:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse ($rent->time_end_use)->format('h:i') }}</td>
                                                <td>{{ $rent->purpose ?? ''}}</td>
                                                <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('d F Y, H:i') }}</td>
                                                <td>{{ $rent->status }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                -- Belum Ada Peminjaman --
                                            </td>
                                        </tr>
                                    @endif
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @if (session('wa_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tunggu 2 detik sebelum mengarahkan ke WhatsApp
            setTimeout(function() {
                const message = `{{ session('wa_message') }}`;
                const adminPhone = `{{ session('admin_phone') }}`;
                const whatsappUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            }, 2000); // 2000 milidetik = 2 detik
        });
    </script>
@endif

@endsection