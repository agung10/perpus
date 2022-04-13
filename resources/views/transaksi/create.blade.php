@extends('layouts.app')

@section('cssLibraries')
<link rel="stylesheet" href="{{asset('template/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
@endsection

@section('content')
<div class="main-content" style="min-height: 536px;">
    <section class="section">
        <div class="section-header">
            <a href="javascript:history.back()"><i class="fas fa-arrow-left mr-2" style="font-size:  20px;"></i></a>

            <h1>Form Tambah Transaksi Peminjaman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Form Tambah Transaksi Peminjaman</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Transaksi Peminjaman</h2>
            <p class="section-lead">
                Form Tambah Transaksi Peminjaman
            </p>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card card-primary">
                        <form method="POST" action="{{route('transaksi.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Tambah Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Transaksi</label>
                                    <input type="text" class="form-control @error('kode_transaksi') is-invalid @enderror" id="kode_transaksi" name="kode_transaksi" value="{{$kodeTransaksi}}" readonly>

                                    @error('kode_transaksi')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <div class="input-group">
                                        <input id="buku_judul" type="text" class="form-control" readonly>
                                        <input id="buku_id" type="hidden" class="form-control @error('buku_id') is-invalid @enderror" value="{{ old('buku_id') }}" name="buku_id" readonly>

                                        <a href="#" data-toggle="modal" data-target="#modalBuku"
                                            style="text-decoration: none;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-primary text-white">
                                                    Cari Buku <i class="ml-1 fas fa-search"></i>
                                                </div>
                                            </div>
                                        </a>

                                        @error('buku_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Buku</label>
                                    <div class="input-group">
                                        <input id="buku_jenis" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Siswa</label>
                                    <div class="input-group">
                                        <input id="siswa_nama" type="text" class="form-control" readonly>
                                        <input id="siswa_id" type="hidden"
                                            class="form-control @error('siswa_id') is-invalid @enderror"
                                            value="{{ old('siswa_id') }}" name="siswa_id" readonly>

                                        <a href="#" data-toggle="modal" data-target="#modalSiswa"
                                            style="text-decoration: none;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-primary text-white">
                                                    Cari Siswa <i class="ml-1 fas fa-search"></i>
                                                </div>
                                            </div>
                                        </a>

                                        @error('siswa_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pinjam (Batas waktu peminjaman maksimal 3 hari)</label>
                                    <input type="text" class="form-control datepicker @error('tgl_pinjam') is-invalid @enderror" name="tgl_pinjam">

                                    @error('tgl_pinjam')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Buku -->
<div class="modal fade bd-example-modal-lg" id="modalBuku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="lookup" class="table table-hover table-striped" id="table-1">
                        <thead>
                            <tr class="text-center">
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Jenis Buku</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukus as $res)
                            <tr class="pilihBuku" data-buku_id="<?= $res->id; ?>" data-buku_judul="<?= $res->judul_buku; ?>" data-buku_jenis="<?= $res->jenis_buku->jenis; ?>">
                                <td class="text-center">{{$res->kode_buku}}</td>
                                <td class="text-center">{{$res->judul_buku}}</td>
                                <td class="text-center">{{$res->jenis_buku->jenis}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Siswa -->
<div class="modal fade bd-example-modal-lg" id="modalSiswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="lookup2" class="table table-hover table-striped" id="table-1">
                        <thead>
                            <tr class="text-center">
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $res)
                            <tr class="pilihSiswa" data-siswa_id="<?= $res->id; ?>" data-siswa_nama="<?= $res->nama; ?>">
                                <td class="text-center">{{$res->nis}}</td>
                                <td class="text-center">{{$res->nama}}</td>
                                <td class="text-center">{{$res->jk}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsLibraries')
<script src="{{asset('template/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('template/js/page/modules-datatables.js')}}"></script>

<script>
    $('#transaksiLink').addClass('active')

    $(document).on('click', '.pilihBuku', function (e) {
        document.getElementById("buku_judul").value = $(this).attr('data-buku_judul');
        document.getElementById("buku_jenis").value = $(this).attr('data-buku_jenis');
        document.getElementById("buku_id").value = $(this).attr('data-buku_id');
        $('#modalBuku').modal('hide');
    });

    $(document).on('click', '.pilihSiswa', function (e) {
        document.getElementById("siswa_nama").value = $(this).attr('data-siswa_nama');
        document.getElementById("siswa_id").value = $(this).attr('data-siswa_id');
        $('#modalSiswa').modal('hide');
    });
    
        $(function () {
        $("#lookup, #lookup2").dataTable();
    });
</script>
@include('layouts.components.alert')
@endsection