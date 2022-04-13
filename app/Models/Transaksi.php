<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
