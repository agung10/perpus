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
            <h1>Data Jenis Buku</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Jenis Buku</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Jenis Buku</h2>
            <p class="section-lead">
                Seluruh informasi data jenis buku
            </p>

            <div class="row">
                <div class="col-4">
                    <div class="card card-primary">
                        <form method="POST" action="{{route('jenis_buku.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Tambah Jenis Buku</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Jenis Buku</label>
                                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis') }}" autocomplete="jenis" name="jenis" placeholder="Masukkan jenis buku">

                                            @error('jenis')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Denda</label>
                                            <input type="text" class="form-control @error('denda') is-invalid @enderror" value="{{ old('denda') }}" autocomplete="denda" name="denda" placeholder="Masukkan denda" onkeypress="return isNumber(event)">

                                            @error('denda')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Jenis Buku</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Denda</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('layouts.__FUNCTIONS.rupiah')
                                        @foreach ($jenis_bukus as $res)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}</td>
                                                <td class="text-center">{{$res->jenis}}</td>
                                                <td class="text-center">{{rupiah($res->denda)}}</td>
                                                <td class="text-center">
                                                    <button id="{{$res->id}}" class="btn btn-sm btn-warning edit"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger" data-uri="{{ route('jenis_buku.destroy', $res->id) }}" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash"></i></button>
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

{{-- Edit Jenis Buku --}}
<div class="modal fade text-left" id="modalJenisBukuEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel33">Ubah Jenis Buku</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formEditJenisBuku" method="POST" action="" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body">
                    <label class="mb-2">Nama Jenis Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis" name="jenis" required>
                        <div class="invalid-feedback">
                            Masukkan jenis buku
                        </div>
                    </div>

                    <label class="mb-2">Denda</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="denda" name="denda" onkeypress="return isNumber(event)" required>
                        <div class="invalid-feedback">
                            Masukkan denda
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
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

<!-- Page Specific JS File -->
<script src="{{asset('template/js/page/modules-datatables.js')}}"></script>

<script>
    $('#masterLink').addClass('active')
    $('#jenisBukuLink').addClass('active')

    // ModalStatusEdit
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        console.log(id)
        $.ajax({
            url: "{{ url('getDataJenisBuku') }}/" + id,
            dataType: "JSON",
            success: function(data) {
                if (data != "") {
                    $('#jenis').val(data.jenis);
                    $('#denda').val(data.denda);
                    $('#modalJenisBukuEdit').click();
                    $('#formEditJenisBuku').attr("action", "{{ url('jenis_buku/') }}/" + id) + "/update";

                    $('#modalJenisBukuEdit').modal("show")
                }
            }
        })
    })

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

@include('layouts.components.modalDestroy')
@include('layouts.components.alert')
@endsection