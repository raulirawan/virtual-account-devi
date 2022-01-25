@extends('layouts.dashboard-admin')

@section('title','Halaman Detail User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail User</h1>
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
                  <h3 class="card-title">Detail User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <th style="width: 400px">Nama Lengkap</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Nomor Handphone</th>
                            <td>{{ $user->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Roles</th>
                            <td>{{ $user->roles }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Alamat</th>
                            <td>{{ $user->address }}</td>
                        </tr>

                    </tbody>
                  </table>
                  <a href="{{ route('user.index') }}" class="btn btn-primary mt-3">Kembali</a>
                </div>

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
