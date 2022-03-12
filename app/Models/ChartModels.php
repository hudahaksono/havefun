<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChartModels extends Model
{
    protected $table = 'ttrx_chart';

    use Notifiable;

    protected $fillable = [
        'id', 'id_product', 'id_paket', 'qty', 'user_at'
    ];
}
