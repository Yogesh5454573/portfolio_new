<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity, TapAdminActivityTrait;

    protected $guard = 'admin';
    protected static $logName = 'Admin log';
    protected static $logOnlyDirty = true;
    protected $primaryKey = 'id';
    Protected $table= 'service';
    protected $fillable = [
        'ser_name',
        'ser_desc',
        'token',
        'status'
    ];
}
