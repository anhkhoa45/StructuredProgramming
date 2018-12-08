<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 15:14
 */

namespace App\Services;
use Illuminate\Http\Request;


/**
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    function index(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    function find($id);

    /**
     * @param $request
     * @return mixed
     */
    function store(Request $request);

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    function update(Request $request, $id);

    /**
     * @param $id
     * @return mixed
     */
    function delete($id);

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate();

    /**
     * Rules update.
     * @return array
     */
    public function rulesUpdate($id);
}
