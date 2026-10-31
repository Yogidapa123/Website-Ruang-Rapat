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
    <section id="blog" class="container blog-area pt-170 pb-140">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <div class="welcome-content">
                    <div class="section-title">
                        <h3 class="mb-35 wow fadeInUp" data-wow-delay=".2s">{{ $room->name }}</h3>
                    </div>
                    <table class="table">
                        <tr><td>Tempat</td><td>: {{ $room->tempat }}</td></tr>
                        <tr><td>Kapasitas</td><td>: {{ $room->capacity }}</td></tr>
                        <tr><td>Deskripsi</td><td>: {{ $room->description }}</td></tr>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-6 text-center">
                @if ($room->img && Storage::exists('public/' . $room->img))
                    <img class="img-fluid rounded" style="border-radius: 50px;" src="{{ asset('storage/' . $room->img) }}" alt="">
                @elseif ($room->img)
                    <img class="img-fluid rounded" style="border-radius: 50px;" src="{{ asset($room->img) }}" alt="">
                @endif
            </div>
        </div>

        <hr class="mt-75">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Pinjam Ruang {{ $room->name }}</h3>
                <p class="wow fadeInUp" data-wow-delay=".4s">Isi form secara lengkap untuk meminjam ruangan</p>
                
                  <!-- Cek Jika Ada Alert -->
                  @if (Session::has('alert'))
                  @php $alert = Session::get('alert'); @endphp
                  @if (isset($alert['avatar']) && isset($alert['message']))
                      <div class="alert alert-danger alert-dismissible fade show position-fixed top-50 start-50 translate-middle p-4 text-center shadow-lg rounded" 
                           role="alert" style="max-width: 400px; z-index: 1100; background: #dc3545; color: white; border: none;">
                          <!-- Tombol Close -->
                          <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>

                          <!-- Gambar Avatar -->
                          <img src="{{ $alert['avatar'] }}" alt="Avatar" class="mx-auto d-block rounded-circle" style="width: 80px; height: 80px; border: 2px solid white;">

                          <!-- Pesan Alert -->
                          <h5 class="fw-bold mt-3 text-white">Pemberitahuan</h5>
                          <p class="mt-2 text-white">{{ $alert['message'] }}</p>

                          <!-- Tombol Tutup -->
                          <button type="button" class="btn btn-light mt-2 px-4" data-bs-dismiss="alert" style="color: #dc3545; font-weight: bold;">Tutup</button>
                      </div>
                  @endif
              @endif
              
                <form class="row g-3 mt-3 needs-validation wow fadeInUp" data-wow-delay=".4s" action="/daftarpinjam" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label for="room_id" class="form-label d-block">Kode Ruangan</label>
                            <select class="form-select" name="room_id" id="room_id" required>
                                <option selected disabled>Pilih Kode Ruangan</option>
                                @foreach ($rooms as $room)
                                    @if ($room->name == request()->segment(count(request()->segments())))
                                        <option value="{{ $room->id }}" selected> {{ $room->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="purpose" class="form-label">Kegiatan</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" value="{{ old('purpose') }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label for="time_start" class="form-label">Mulai Pinjam</label>
                            <input type="datetime-local" class="form-control" id="time_start_use" name="time_start_use" value="{{ old('time_start_use') }}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="time_end" class="form-label">Selesai Pinjam</label>
                            <input type="datetime-local" class="form-control" id="time_end_use" name="time_end_use" value="{{ old('time_end_use') }}" required>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-warning rounded-pill fw-semibold text-white" type="submit">Pinjam Ruang</button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="mt-75">
        <h3 class="text-center">Daftar Peminjaman</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" style="background-color: red; color: white;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Bidang Peminjam</th>
                        <th>Tanggal</th>
                        <th>Mulai Pinjam</th>
                        <th>Selesai Pinjam</th>
                        <th>Kegiatan</th>
                        <th>Waktu Peminjaman</th>
                        <th>Status Pinjam</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black">
                    @if ($rents->count() > 0)
                        @foreach ($rents as $rent)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $rent->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->translatedFormat('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->translatedFormat('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($rent->time_end_use)->translatedFormat('H:i') }}</td>
                                <td>{{ $rent->purpose }}</td>
                                <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('d F Y, H:i') }}</td>
                                <td>{{ $rent->status }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">-- Belum Ada Peminjaman --</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
@endsection