<?php

namespace App\Models;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

trait TapAdminActivityTrait {

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->ip_address = request()->ip();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logAll()
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }
}
