<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Info extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, TapAdminActivityTrait;

    protected static $logName = 'Admin log';
    protected static $logOnlyDirty = true;

    protected $primaryKey = 'id';
    protected $table = 'info';

    protected $fillable = [
        'token',
        'name',
        'dob',
        'degree',
        'phone',
        'experience',
        'email',
        'about_me',
        'address',
        'freelance',
        'photo',
        'resume_file',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
