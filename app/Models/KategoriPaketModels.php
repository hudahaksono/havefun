<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class KategoriPaketModels extends Model
{
    protected $table = 'tmst_kategori_paket';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'peruntukan', 'keterangan', 'status_hapus', 'user_at'
    ];
}
