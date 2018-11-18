<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 19:19
 */

namespace App\Storage\LaravelImpl;


use App\Storage\UserAvatarStorageInterface;
use App\User;

class UserAvatarStorage extends Storage implements UserAvatarStorageInterface
{
    const PUBLIC_DIR = '/storage/avatars/';
    const DEFAULT_IMAGE = '/storage/avatars/default.jpg';

    /**
     * @return string path to base directory relative by @projectDir/storage/app
     */
    function baseDir()
    {
        return storage_path('app/public/avatars');
    }

    /**
     * @param User $user
     * @return mixed
     */
    function getUserPublicAvatar(User $user)
    {
        if($user->avatar == '' || !$this->checkExist($user->avatar))
            return self::DEFAULT_IMAGE;

        return self::PUBLIC_DIR.$user->image;
    }
}
