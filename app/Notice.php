<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notice extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'id';
    protected $incrementing = 'false';

    protected $fillable = [
        'id',
        'notice',
        'notification',
        'noticelink',
        'telegramid',
    ];
}
