<?php

namespace gotham;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'permission_level', 'account_status',
    ];
    
    public function projects(){
        
        return $this->belongsToMany('gotham\Project');
    }
    
    public function rfis(){
        
        return $this->hasMany('gotham\RFI');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
