<?php

namespace App\Models\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserModels extends Model
{
    protected $table = 'mst_users';

    use Notifiable;

    protected $fillable = [
        'id', 'email', 'password', 'nama', 'jabatan', 'status_hapus', 'created_at', 'updated_at'
    ];
}
