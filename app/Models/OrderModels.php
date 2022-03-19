<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderModels extends Model
{
    protected $table = 'ttrx_order';

    use Notifiable;

    protected $fillable = [
        'id', 'no_order', 'tgl_order', 'id_user', 'id_product', 'id_paket', 'id_chart', 'qty', 'status', 'status_product', 'user_at'
    ];
}
