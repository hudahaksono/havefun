<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MessageModels extends Model
{
    protected $table = 'trpt_message';

    use Notifiable;

    protected $fillable = [
        'id', 'nama', 'email', 'tanggal', 'no_tlp', 'pesan', 'created_at', 'updated_at'
    ];
}
