@extends('layouts.app')

@section('cssLibraries')
<link rel="stylesheet" href="{{asset('template/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet"
    href="{{asset('template/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi</h4>
                        </div>
                        <div class="card-body">
                            {{$transaksis->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sedang Dipinjam</h4>
                        </div>
                        <div class="card-body">
                            {{$transaksis->where('status', 'pinjam')->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Buku</h4>
                        </div>
                        <div class="card-body">
                            {{$bukus->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Siswa</h4>
                        </div>
                        <div class="card-body">
                            {{$siswas->count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Buku Sedang Dipinjam</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Judul Buku</th>
                                        <th>Peminjam</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('layouts.__FUNCTIONS.tanggal_indo')

                                    @foreach ($transaksis->where('status', 'pinjam') as $res)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-center">{{$res->kode_transaksi}}</td>
                                            <td class="text-center">{{$res->buku->judul_buku}}</td>
                                            <td class="text-center">{{$res->siswa->nama}}</td>
                                            <td class="text-center">{{tgl_indo($res->tgl_pinjam)}}</td>
                                            @if (!empty($res->tgl_kembali))
                                                <td class="text-center">{{tgl_indo($res->tgl_kembali)}}</td>
                                            @else
                                                <td class="text-center">Belum Mengembalikan</td>
                                            @endif
                                            @if ($res->status = "pinjam")
                                                <td class="text-center">
                                                    <span class="badge badge-warning">{{$res->status}}</span>
                                                </td>
                                            @elseif ($res->status = "kembali")
                                                <td class="text-center">
                                                    <span class="badge badge-success">{{$res->status}}</span>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('jsLibraries')
<!-- JS Libraies -->
<script src="{{asset('template/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('template/modules/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Page Specific JS File -->
<script src="{{asset('template/js/page/index-0.js')}}"></script>
<script src="{{asset('template/js/page/modules-datatables.js')}}"></script>

<script>
    $('#dashboardLink').addClass('active')
</script>

@include('layouts.components.alert')
@endsection