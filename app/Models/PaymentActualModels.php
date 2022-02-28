<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentActualModels extends Model
{
    protected $table = 'ttrx_actual_payment';

    use Notifiable;

    protected $fillable = [
        'id', 'id_payment', 'actual_payment'
    ];
}