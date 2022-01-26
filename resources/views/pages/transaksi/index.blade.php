@extends('layouts.dashboard-user')

@section('title', 'Halaman Transaksi Siswa')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaksi Siswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi Siswa</li>
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

                                <table id="example1" class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 10%">Bulan</th>
                                            <th style="width: 10%">Kode Transaksi</th>
                                            <th style="width: 10%">NISN</th>
                                            <th>Nama Siswa</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Total Harga</th>
                                            <th style="width: 5%">Link</th>
                                            <th style="width: 5%">Aksi</th>

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
                                                    @if ($item->payment_url != null || $item->status == 'GAGAL')
                                                    <a href="{{ $item->payment_url }}" target="_blank" class="btn btn-sm btn-success">
                                                        Link
                                                    </a>

                                                    @endif
                                                </td>
                                                <td>
                                                  @if ($item->payment_url == null)
                                                  <form target="_blank" action="{{ route('siswa.bayar', $item->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-info mr-1" style='float: left;'>Bayar</button>
                                                </form>
                                                  @endif


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
