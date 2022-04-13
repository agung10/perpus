@extends('layouts.app')

@section('cssLibraries')
<link rel="stylesheet" href="{{asset('template/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi Peminjaman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Transaksi Peminjaman</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Transaksi Peminjaman</h2>
            <p class="section-lead">
                Seluruh informasi data transaksi peminjaman
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Buku Sedang Dipinjam</h4>
                            <div class="card-header-action">
                                <a href="{{route('transaksi.create')}}" class="btn btn-primary">Tambah Transaksi</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Judul Buku</th>
                                            <th>Peminjam</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Status</th>
                                            <th>Telat / Denda</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('layouts.__FUNCTIONS.tanggal_indo')
                                        @foreach ($transaksis as $res)
                                            @php
                                                $tgl_pinjam = $res->tgl_pinjam;
                                                $tgl_kembali = date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(3)->toDateString()));
                                                $selisih = strtotime($tgl_kembali) - strtotime($tgl_pinjam);
                                                $hari = abs(round($selisih / 86400));
                                            @endphp    
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
                                                @if ($res->status == "pinjam")
                                                    <td class="text-center">
                                                        <span class="badge badge-warning">{{$res->status}}</span>
                                                    </td>
                                                @elseif ($res->status == "kembali")
                                                    <td class="text-center">
                                                        <span class="badge badge-success">{{$res->status}}</span>
                                                    </td>
                                                @endif
                                                <td class="text-center">{{$hari - 3}} Hari /</td>
                                                <td>
                                                    <div class="dropdown d-inline">
                                                        <span class="btn btn-sm btn-icon btn-primary dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 30px;">
                                                            Aksi
                                                        </span>
                                                        <div class="dropdown-menu">
                                                            @if ($res->status == "pinjam")
                                                                <a id="{{$res->id}}" class="dropdown-item has-icon edit" href="#" data-toggle="modal" data-target="#modalKembali"><i class="fas fa-undo"></i>Kembalikan</a>
                                                            @endif
                                                            <a class="dropdown-item has-icon" href="#" data-uri="{{ route('siswa.destroy', $res->id) }}" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash"></i> Hapus Data</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Pengembalian Buku --}}
<div class="modal fade text-left" id="modalPengambalian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel33">Form Pengembalian Data Buku</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formPengambalian" method="POST" action="" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body">
                    <label class="mb-2">Kode Transaksi</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" disabled>
                    </div>
                    
                    <label class="mb-2">Judul Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul_buku" name="judul_buku" disabled>
                    </div>

                    <label class="mb-2">Jenis Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis" name="jenis" disabled>
                    </div>

                    <label class="mb-2">Peminjam</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="siswa_id" name="siswa_id" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="mb-2">Tanggal Pinjam</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="tgl_pinjam" name="tgl_pinjam" disabled>
                            </div>        
                        </div>
                        <div class="col-md-6">
                            <label class="mb-2">Tanggal Kembali</label>
                            <div class="form-group">
                                <input type="text" class="form-control datepicker" id="tgl_kembali" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" readonly>
                            </div>        
                        </div>
                    </div>

                    <label class="mb-2">Denda</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="denda" name="denda" disabled>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jsLibraries')
<!-- JS Libraies -->
<script src="{{asset('template/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('template/modules/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('template/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Page Specific JS File -->
<script src="{{asset('template/js/page/modules-datatables.js')}}"></script>

<script>
    $('#transaksiLink').addClass('active')

    // ModalStatusEdit
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        console.log(id)
        $.ajax({
            url: "{{ url('getDataPengembalian') }}/" + id,
            dataType: "JSON",
            success: function(data) {
                if (data != "") {
                    $('#kode_transaksi').val(data.kode_transaksi);
                    $('#judul_buku').val(data.judul_buku);
                    $('#jenis').val(data.jenis);
                    $('#siswa_id').val(data.siswa_id);
                    $('#tgl_pinjam').val(data.tgl_pinjam);
                    $('#denda').value
                    console.log(data.denda);
                    console.log(data.tgl_kembali);
                    $('#modalPengambalian').click();
                    $('#formPengambalian').attr("action", "{{ url('transaksi/') }}/" + id) + "/update";
                    $('#modalPengambalian').modal("show")
                }
            }
        })
    })
</script>

@include('layouts.components.modalDestroy')
@include('layouts.components.alert')
@endsection