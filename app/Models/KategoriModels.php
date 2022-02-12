<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class KategoriModels extends Model
{
    protected $table = 'tmst_kategori';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'peruntukan', 'keterangan', 'status_hapus', 'user_at'
    ];}
