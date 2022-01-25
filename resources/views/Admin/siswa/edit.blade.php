@extends('layouts.dashboard-admin')

@section('title', 'Halaman Edit User')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Data User</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('user.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $user->name }}" name="name" placeholder="Nama Lengkap">
                                        <div class="invalid-feedback">
                                            Masukan Nama Lengkap
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ $user->email }}" name="email" placeholder="Email">
                                        <div class="invalid-feedback">
                                            Masukan Email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No Handphone</label>
                                        <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror"
                                            value="{{ $user->phoneNumber }}" name="phoneNumber"
                                            placeholder="Nomor Handphone User">
                                        <div class="invalid-feedback">
                                            Masukan Nomor Hanphone
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat Lengkap</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                            value="" placeholder="Alamat User">{{ $user->address }}</textarea>
                                        <div class="invalid-feedback">
                                            Masukan Alamat
                                        </div>
                                    </div>
                                </div>



                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
