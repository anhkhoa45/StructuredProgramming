<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 10:59
 */

namespace App\Repositories;


interface RepositoryInterface
{
    function all($orderBy, $where, $searchBy);
    function store();
}
