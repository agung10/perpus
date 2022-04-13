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
            <h1>Data Buku</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Buku</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Buku</h2>
            <p class="section-lead">
                Seluruh informasi data buku
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Buku</h4>
                            <div class="card-header-action">
                                <a href="" data-toggle="modal" data-target="#modalBukuAdd" class="btn btn-primary">Tambah Data Buku</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Jenis Buku</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bukus as $res)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}</td>
                                                <td class="text-center">{{$res->kode_buku}}</td>
                                                <td class="text-center">{{$res->judul_buku}}</td>
                                                <td class="text-center">{{$res->jenis_buku->jenis}}</td>
                                                <td class="text-center">
                                                    <button id="{{$res->id}}" class="btn btn-sm btn-warning edit"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger" data-uri="{{ route('buku.destroy', $res->id) }}" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash"></i></button>
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

{{-- Add Jenis Buku --}}
<div class="modal fade text-left" id="modalBukuAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel33">Tambah Data Buku</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <label class="mb-2">Kode Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" value="{{ old('kode_buku') }}" autocomplete="kode_buku" name="kode_buku" placeholder="Masukkan kode buku">

                        @error('kode_buku')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <label class="mb-2">Judul Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" value="{{ old('judul_buku') }}" autocomplete="judul_buku" name="judul_buku" placeholder="Masukkan judul buku">

                        @error('judul_buku')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <label class="mb-2">Jenis Buku</label>
                    <div class="form-group">
                        <select class="form-control @error('jenis_buku_id') is-invalid @enderror" name="jenis_buku_id">
                            <option selected disabled>Pilih Jenis Buku</option>
                            @foreach ($jenis_bukus as $res)
                                <option value="{{$res->id}}">{{$res->jenis}}</option>
                            @endforeach
                        </select>

                        @error('jenis_buku_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Jenis Buku --}}
<div class="modal fade text-left" id="modalBukuEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel33">Ubah Data Buku</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formEditBuku" method="POST" action="" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body">
                    <label class="mb-2">Kode Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>

                        <div class="invalid-feedback">
                            Masukkan kode buku
                        </div>
                    </div>
                    
                    <label class="mb-2">Judul Buku</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>

                        <div class="invalid-feedback">
                            Masukkan judul buku
                        </div>
                    </div>

                    <label class="mb-2">Jenis Buku</label>
                    <div class="form-group">
                        <select class="form-control" id="jenis_buku_id" name="jenis_buku_id" required>
                            <option value="" selected disabled> Pilih Jenis Buku </option>
                            @foreach($jenis_bukus as $key)
                                <option value="{{ $key->id }}"> {{ $key->jenis }} </option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                            Masukkan jenis buku
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
    $('#bukuLink').addClass('active')

    // ModalStatusEdit
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        console.log(id)
        $.ajax({
            url: "{{ url('getDataBuku') }}/" + id,
            dataType: "JSON",
            success: function(data) {
                if (data != "") {
                    $('#kode_buku').val(data.kode_buku);
                    $('#judul_buku').val(data.judul_buku);
                    $('#jenis_buku_id').val(data.jenis_buku_id);
                    $('#modalBukuEdit').click();
                    $('#formEditBuku').attr("action", "{{ url('buku/') }}/" + id) + "/update";

                    $('#modalBukuEdit').modal("show")
                }
            }
        })
    })
</script>

@include('layouts.components.modalDestroy')
@include('layouts.components.alert')
@endsection