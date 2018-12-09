<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 18:57
 */

namespace App\Services;


interface UserServiceInterface extends CRUDServiceInterface
{
    /**
     * Count user
     * @return user number
     */
    function count();
}
