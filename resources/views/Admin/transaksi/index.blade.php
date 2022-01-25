@extends('layouts.dashboard-admin')

@section('title', 'Halaman Transaksi')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
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
                                <h3 class="card-title">Data Transaksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-global">
                                    (+) Tambah Pembayaran Global
                                </button>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#modal-per-siswa">
                                    (+) Tambah Per Siswa
                                </button>

                                <table id="example1" class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 10%">Bulan</th>
                                            <th style="width: 10%">Kode Transaksi</th>
                                            <th style="width: 10%">NISN</th>
                                            <th>Nama Siswa</th>
                                            <th style="width: 10%">Status</th>
                                            <th >Total Harga</th>
                                            <th style="width: 10%">Is Active</th>
                                            <th >Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('F') }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->siswa->nisn }}</td>
                                                <td>{{ $item->siswa->name }}</td>
                                               <td>
                                                @if ($item->status == 'PENDING')
                                                <span class="badge badge-warning">PENDING</span>
                                                @elseif ($item->status == 'SUCCESS')
                                                <span class="badge badge-success">SUKSES</span>
                                                @else
                                                <span class="badge badge-danger">GAGAL</span>
                                                @endif
                                               </td>
                                                <td>{{ number_format($item->total_harga) }}</td>
                                                <td>
                                                    @if ($item->is_active == 1)
                                                    <span class="badge badge-success">Aktif</span>
                                                    @else
                                                    <span class="badge badge-danger">Non Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.transaksi.detail', $item->id) }}"
                                                        class="btn btn-sm btn-info mr-1" style='float: left;'>Detail</a>
                                                    @if ($item->is_active == 1)
                                                    <a href="{{ route('admin.transaksi.non.active', $item->id) }}"
                                                        class="btn btn-sm btn-danger mr-1" style='float: left;' onclick="return confirm('Yakin ?') ">Non Active</a>
                                                    @else
                                                    <a href="{{ route('admin.transaksi.active', $item->id) }}"
                                                        class="btn btn-sm btn-success mr-1" style='float: left;' onclick="return confirm('Yakin ?') ">Set Active</a>
                                                    @endif
                                                    {{-- <button type="button" id="edit" data-toggle="modal"
                                                        data-target="#modal-edit" data-id="{{ $item->id }}"
                                                        data-transaksi="{{ $item->transaksi }}"
                                                        class="btn btn-sm btn-primary" style='float: left;'>Edit</button> --}}

                                                    {{-- <form action="{{ route('admin.transaksi.delete', $item->id) }}"
                                                        method="POST" style='float: left; padding-left: 5px;'>
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ?')">Hapus</button>
                                                    </form> --}}
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

    <!-- Modal Global -->
    <div class="modal fade" id="modal-global" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran Global</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.transaksi.global') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Pembayaran</label>
                               <select  required name="pembayaran[]" id="pembayaran" class="form-control select2" id="pembayaran" multiple="multiple" data-placeholder="Pilih Pembayaran" style="width: 100%;">>
                                    @foreach ($pembayaran as $pbyrn)
                                        <option value="{{ $pbyrn->id }}">{{ $pbyrn->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


      <!-- Modal Global -->
      <div class="modal fade" id="modal-per-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran Per Siswa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('admin.transaksi.per.siswa') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                           <select  name="siswa" id="siswa" class="form-control" id="siswa" style="width: 100%;" required>
                                <option value="">-- Pilih Nama Siswa --</option>

                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                          <div class="form-group">
                              <label>Nama Pembayaran</label>
                             <select  name="pembayaran[]" id="pembayaran_siswa" class="form-control select2" id="pembayaran" multiple="multiple" required data-placeholder="Pilih Pembayaran" style="width: 100%;">>
                                  @foreach ($pembayaran as $pbyrn)
                                      <option value="{{ $pbyrn->id }}">{{ $pbyrn->nama }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" id="simpan" class="btn btn-primary">Simpan Data</button>
              </div>
              </form>

          </div>
      </div>
  </div>
    <!-- Modal Edit -->
    {{-- <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Transaksi</label>
                                <input type="text" class="form-control @error('transaksi') is-invalid @enderror"
                                    value="{{ old('transaksi') }}" id="transaksi" name="transaksi" placeholder="Masukan Transaksi" required>
                                <div class="invalid-feedback">
                                    Masukan Transaksi
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
    </div> --}}



@endsection
@push('down-style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #ffffff !important;
    }
</style>
@endpush
@push('down-script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

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


        $('#pembayaran').select2()
        $('#pembayaran_siswa').select2()


            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var transaksi = $(this).data('transaksi');

                $('#transaksi').val(transaksi);

                $('#form-edit').attr('action','/admin/transaksi/update/' + id);
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
