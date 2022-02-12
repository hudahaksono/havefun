<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BarangModels extends Model
{
    protected $table = 'tmst_product';

    use Notifiable;

    protected $fillable = [
        'id', 'id_kategori', 'id_ukuran', 'nama', 'nama_singkat', 'satuan', 'file_name', 'file_name_multi', 'keterangan', 'status_hapus', 'user_at'
    ];
}
