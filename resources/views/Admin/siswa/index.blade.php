@extends('layouts.dashboard-admin')

@section('title', 'Halaman Siswa')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Siswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Siswa</li>
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
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Siswa</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    (+) Tambah Siswa
                                </button>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th style="width: 20%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswa as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nisn }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->kelas->kelas }}</td>
                                                {{-- <td>{{ $item->jurusan->nama_jurusan }}</td> --}}
                                                <td>
                                                    <button type="button" id="edit" data-toggle="modal"
                                                        data-target="#modal-edit"
                                                        data-id="{{ $item->id }}"
                                                        data-kelas="{{ $item->kelas_id }}"
                                                        data-jurusan="{{ $item->jurusan_id }}"
                                                        data-nama="{{ $item->name }}" data-email="{{ $item->email }}"
                                                        data-nisn="{{ $item->nisn }}" data-alamat="{{ $item->alamat }}"
                                                        class="btn btn-sm btn-primary" style='float: left;'>Edit</button>
                                                    <form action="{{ route('admin.siswa.delete', $item->id) }}"
                                                        method="POST" style='float: left; padding-left: 5px;'>
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.siswa.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NISN</label>
                                <input type="number" class="form-control @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn') }}" name="nisn" placeholder="NISN" required>
                                <div class="invalid-feedback">
                                    Masukan NISN
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name" placeholder="Nama Lengkap" required>
                                <div class="invalid-feedback">
                                    Masukan Nama Lengkap
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kelas</label>
                                <select name="kelas" class="form-control" @error('kelas') is-invalid @enderror required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Masukan Kelas
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Jurusan</label>
                                <select name="jurusan" class="form-control" @error('jurusan') is-invalid @enderror required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $jrs)
                                    <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Masukan Jurusan
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" name="email" placeholder="Email" required>
                                <div class="invalid-feedback">
                                    Masukan Email
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" name="password" placeholder="Password" required>
                                <div class="invalid-feedback">
                                    Masukan Password
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Lengkap</label>
                                <textarea required name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                    value="" placeholder="Alamat User">{{ old('alamat') }} </textarea>
                                <div class="invalid-feedback">
                                    Masukan Alamat
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NISN</label>
                                <input type="number" class="form-control @error('nisn-edit') is-invalid @enderror"
                                    value="{{ old('nisn') }}" name="nisn" id="nisn" placeholder="NISN" required>
                                <div class="invalid-feedback">
                                    Masukan NISN
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name-edit') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name" id="nama" placeholder="Nama Lengkap" required>
                                <div class="invalid-feedback">
                                    Masukan Nama Lengkap
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" @error('kelas') is-invalid @enderror required>
                                    @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Masukan Kelas
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control" @error('jurusan') is-invalid @enderror required>
                                    @foreach ($jurusan as $jrs)
                                    <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Masukan Jurusan
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email-edit') is-invalid @enderror"
                                    value="{{ old('email') }}" name="email" id="email" placeholder="Email" required>
                                <div class="invalid-feedback">
                                    Masukan Email
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Lengkap</label>
                                <textarea id="alamat" required name="alamat"
                                    class="form-control @error('alamat-edit') is-invalid @enderror" value=""
                                    placeholder="Alamat User">{{ old('alamat') }} </textarea>
                                <div class="invalid-feedback">
                                    Masukan Alamat
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>



@endsection

@push('down-script')
    @if (count($errors) > 0)
        <script type="text/javascript">
            $(document).ready(function () {
                $('#exampleModal').modal('show');
            });
        </script>
         <script type="text/javascript">
            $(document).ready(function () {
                $('#modal-edit').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var email = $(this).data('email');
                var nisn = $(this).data('nisn');
                var alamat = $(this).data('alamat');
                var jurusan = $(this).data('jurusan');
                var kelas = $(this).data('kelas');

                $('#nama').val(nama);
                $('#email').val(email);
                $('#nisn').val(nisn);
                $('#jurusan').val(jurusan).change();
                $('#kelas').val(kelas).change();
                $('#alamat').text(alamat);

                $('#form-edit').attr('action','/admin/siswa/update/' + id);
            });
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
