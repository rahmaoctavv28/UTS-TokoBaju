@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <!-- Profil -->
        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <img src="https://ui-avatars.com/api/?name=Admin&background=7c3aed&color=fff&size=180"
                         class="rounded-circle shadow mb-3"
                         width="180">

                    <h4 class="fw-bold">
                        Administrator
                    </h4>

                    <p class="text-muted">
                        admin@gmail.com
                    </p>

                    <span class="badge bg-success">
                        Admin
                    </span>

                </div>

            </div>

        </div>

        <!-- Form -->
        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        <i class="bi bi-person-circle"></i>

                        Profil Admin

                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

                    <form action="{{ route('profil.update') }}"
                          method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <label>Nama Lengkap</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="Administrator">

                            </div>

                            <div class="col-md-6">

                                <label>Email</label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="admin@gmail.com">

                            </div>

                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-6">

                                <label>No HP</label>

                                <input
                                    type="text"
                                    class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label>Alamat</label>

                                <input
                                    type="text"
                                    class="form-control">

                            </div>

                        </div>

                        <hr>

                        <h5>

                            Ganti Password

                        </h5>

                        <div class="row">

                            <div class="col-md-4">

                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password Lama">

                            </div>

                            <div class="col-md-4">

                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password Baru">

                            </div>

                            <div class="col-md-4">

                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Konfirmasi Password">

                            </div>

                        </div>

                        <br>

                        <button class="btn btn-primary">

                            <i class="bi bi-save"></i>

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection