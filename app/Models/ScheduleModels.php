<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ScheduleModels extends Model
{
    protected $table = 'ttrx_schedule';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'tgl_dari', 'tgl_sampai', 'no_order', 'tempat', 'keterangan', 'status', 'user_at'
    ];
}