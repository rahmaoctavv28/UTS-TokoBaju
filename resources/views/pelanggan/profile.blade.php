@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <div class="row g-4">
        <!-- Card Profil -->
        <div class="col-lg-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->nama) }}&background=ff1493&color=fff&size=200" class="rounded-circle shadow mb-3" width="180" height="180">
                    <h3 class="fw-bold mb-1">
                        {{ $pelanggan->nama }}
                    </h3>
                    <p class="text-muted mb-3">
                        {{ $pelanggan->email }}
                    </p>
                    <span class="badge bg-success px-3 py-2">
                        Member Geulis Sandhangan
                    </span>
                </div>
            </div>
        </div>
        <!-- Form Profil -->
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-dark text-white py-3">
                    <h4 class="mb-0">
                        <i class="fa-solid fa-user me-2"></i>
                        Profil Saya
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('pelanggan.profil.update',$pelanggan->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Nama Lengkap
                                </label>
                                <input type="text"1qqq name="nama" class="form-control" value="{{ $pelanggan->nama }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control" value="{{ $pelanggan->email }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Nomor HP
                                </label>
                                <input type="text" name="telepon" class="form-control" value="{{ $pelanggan->telepon }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Alamat
                                </label>
                                <input type="text" name="alamat" class="form-control" value="{{ $pelanggan->alamat }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    Catatan
                                </label>
                                <textarea class="form-control" rows="4" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection