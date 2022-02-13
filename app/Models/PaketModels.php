<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaketModels extends Model
{
    protected $table = 'tmst_paket';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'keterangan', 'status_hapus', 'created_at', 'updated_at'
    ];
}
