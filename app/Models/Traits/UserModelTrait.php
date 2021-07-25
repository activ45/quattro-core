<?php


namespace App\Models\Traits;


use App\Models\Department;
use App\Models\Ticket;
use Spatie\Permission\Models\Permission;

trait UserModelTrait
{
    //RELATIONSHIPS

    // GETTERS
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function getNotificationsAttribute(){
        return $this->notifications()->get();
    }
    public function getUnreadNotificationsAttribute(){
        return $this->unreadNotifications()->get();
    }
    public function getIsOnlineAttribute()
    {
        return $this->isOnline();
    }
    public function getIsAdminAttribute()
    {
        return $this->hasRole(['admin','super-admin']);
    }
    public function getPermissionsAllAttribute()
    {
        return $this->getAllPermissions()->transform(function(Permission $item){
            return $item->only('name','description');
        });
    }

    // SETTERS
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = \Str::ucfirst($value);
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = \Str::upper($value);
    }
}
