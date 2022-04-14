@error('name')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('email')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('password')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('nis')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('nama')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('jk')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('jenis')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('denda')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('kode_buku')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('judul_buku')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('jenis_buku_id')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('kode_transaksi')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('tgl_pinjam')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('tgl_kembali')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('buku_id')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror

@error('siswa_id')
<script>
    iziToast.error({
        title: 'Gagal!',
        message: '{{$message}}',
        position: 'bottomRight'
    });
</script>
@enderror



@if(session("alertStore"))
<script>
    iziToast.success({
        title: 'Berhasil!',
        message: '{{ session('alertStore') }} Berhasil Ditambah',
        position: 'bottomRight'
    });
</script>
@elseif(session("alertUpdate"))
<script>
    iziToast.success({
        title: 'Berhasil!',
        message: '{{ session('alertUpdate') }} Berhasil Diubah',
        position: 'bottomRight'
    });
</script>
@elseif(session("alertDestroy"))
<script>
    iziToast.success({
        title: 'Berhasil!',
        message: '{{ session('alertDestroy') }} Berhasil Dihapus',
        position: 'bottomRight'
    });
</script>
@elseif (session()->has('success'))
<script>
    iziToast.info({
        title: 'Info!',
        message: 'Selamat datang di aplikasi perpustakaan versi 1.0',
        position: 'bottomCenter'
    });
</script>
@endif