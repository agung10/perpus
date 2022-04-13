@extends('layouts.app')

@section('cssLibraries')
<link rel="stylesheet" href="{{asset('template/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Siswa</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Siswa</h2>
            <p class="section-lead">
                Seluruh informasi data siswa
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Siswa</h4>
                            <div class="card-header-action">
                                <a href="{{route('siswa.create')}}" class="btn btn-primary">Tambah Siswa</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswas as $res)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}</td>
                                                <td class="text-center">{{$res->nis}}</td>
                                                <td class="text-center">{{$res->nama}}</td>
                                                <td class="text-center">{{$res->jk}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('siswa.edit', $res->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-uri="{{ route('siswa.destroy', $res->id) }}" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash"></i></button>
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
@endsection

@section('jsLibraries')
<!-- JS Libraies -->
<script src="{{asset('template/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('template/modules/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Page Specific JS File -->
<script src="{{asset('template/js/page/modules-datatables.js')}}"></script>

<script>
    $('#masterLink').addClass('active')
    $('#siswaLink').addClass('active')
</script>

@include('layouts.components.modalDestroy')
@include('layouts.components.alert')
@endsection