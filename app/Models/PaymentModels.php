<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentModels extends Model
{
    protected $table = 'ttrx_payment';

    use Notifiable;

    protected $fillable = [
        'id', 'no_payment', 'tgl_payment', 'total_payment', 'id_user', 'id_order', 'no_order', 'tgl_acara', 'alamat_acara', 'status', 'user_at'
    ];
}
