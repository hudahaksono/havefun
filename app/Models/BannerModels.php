<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BannerModels extends Model
{
    protected $table = 'tmst_banner';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'file_name', 'keterangan', 'user_at', 'created_at', 'updated_at'
    ];
}
