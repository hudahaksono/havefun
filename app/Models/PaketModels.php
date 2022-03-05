<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaketModels extends Model
{
    protected $table = 'tmst_paket';

    use Notifiable;

    protected $fillable = [
        'id', 'id_kategori', 'nama', 'file_name', 'file_name_multi', 'keterangan', 'harga', 'status_hapus', 'created_at', 'updated_at'
    ];
}
