<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 19:17
 */

namespace App\Storage;


use App\User;

interface UserAvatarStorageInterface extends StorageInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    function getUserPublicAvatar(User $user);
}
