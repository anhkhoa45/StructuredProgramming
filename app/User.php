<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const PATH_AVATAR = 'uploads/users/avatars/';
    const PATH_AVATAR_DEFAULT = 'uploads/users/avatars/default.png';
    const CAN_NOT_DELETE = 1;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get avatar url of user
     * @return type
     */
    public function getAvatarUrl()
    {
        if ($this->avatar == '') {
            return url(self::PATH_AVATAR_DEFAULT);
        }
        return url($this->avatar);
    }
    
    /**
     * Get role of user array data
     * @return type
     */
    public function roleArr()
    {
        return [
            self::ROLE_ADMIN => 'ADMIN',
            self::ROLE_USER => 'USER'
        ];
    }
    
    /**
     * Convert role of user to string
     * @return string
     */
    public function roleToString()
    {
        $roleId = $this->role_id;
        $roles = $this->roleArr();
        if (isset($roles[$roleId])) {
            return $roles[$roleId];
        }
        return 'N/A';
    }
    
    /**
     * Get active of user array data
     * @return type
     */
    public function activeArr()
    {
        return [
            self::ACTIVE => trans('backend/user.active'),
            self::INACTIVE => trans('backend/user.inactive')
        ];
    }
    
    /**
     * Convert active of user to string
     * @return string
     */
    public function activeToString()
    {
        $key = $this->active;
        $arr = $this->activeArr();
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return 'N/A';
    }
    
    /**
     * Get active of user array data
     * @return type
     */
    public function activeLbArr()
    {
        return [
            self::ACTIVE => 'label-success',
            self::INACTIVE => 'label-danger'
        ];
    }
    
    /**
     * Convert active of user to label
     * @return string
     */
    public function activeToLbClass()
    {
        $key = $this->active;
        $arr = $this->activeLbArr();
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return 'label-default';
    }
}
