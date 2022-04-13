@extends('layouts.app')

@section('cssLibraries')
<link rel="stylesheet" href="{{asset('template/modules/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<div class="main-content" style="min-height: 536px;">
    <section class="section">
        <div class="section-header">
            <a href="javascript:history.back()"><i class="fas fa-arrow-left mr-2" style="font-size:  20px;"></i></a>

            <h1>Form Ubah Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Form Ubah Siswa</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Ubah Siswa</h2>
            <p class="section-lead">
                Form Ubah Siswa
            </p>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card card-primary">
                        <form method="POST" action="{{route('siswa.update', $siswa->id)}}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="card-header">
                                <h4>Ubah Siswa</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input type="text" class="form-control" name="nis" value="{{$siswa->nis}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{$siswa->nama}}">

                                            @error('nama')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control select2 @error('jk') is-invalid @enderror" name="jk">
                                                <?php $jk = ['Laki-Laki', 'Perempuan']; ?>
                                                @foreach($jk as $key)
                                                    @if($siswa->jk == $key)
                                                        <option value="{{ $key }}" selected> {{ $key }} </option>
                                                    @else
                                                        <option value="{{ $key }}"> {{ $key }} </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @error('jk')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('jsLibraries')
<script src="{{asset('template/modules/select2/dist/js/select2.full.min.js')}}"></script>

<script>
    $('#masterLink').addClass('active')
    $('#siswaLink').addClass('active')

    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
@include('layouts.components.alert')
@endsection