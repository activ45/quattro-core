<?php


namespace App\Models\Traits;


trait UserModelTrait
{

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = \Str::ucfirst($value);
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = \Str::upper($value);
    }
    public function getNotificationsAttribute(){
        return $this->notifications()->get();
    }
    public function getUnreadNotificationsAttribute(){
        return $this->unreadNotifications()->get();
    }
}
