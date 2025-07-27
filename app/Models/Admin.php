<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity, TapAdminActivityTrait;

    protected $guard = 'admin';
    protected static $logName = 'Admin log';
    protected static $logOnlyDirty = true;
    protected $primaryKey = 'id';
    Protected $table= 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'admin_type',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
