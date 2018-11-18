<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 18:57
 */

namespace App\Services\Implementation;


use App\Services\UserServiceInterface;
use App\Storage\LaravelImpl\UserAvatarStorage;
use App\User;
use Illuminate\Http\Request;
use League\Flysystem\FileExistsException;

class UserService implements UserServiceInterface
{
    const PAGE_SIZE = 6;

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed|min:4',
            'avatar' => 'max:4096|mimes:png,jpg,jpeg,gif'
        ];
    }

    /**
     * Rules update.
     * @return array
     */
    public function rulesUpdate($id)
    {
        $rules = $this->rulesCreate();
        $rules['email'] = "required|email|unique:users,email,$id,id,deleted_at,NULL";
        return $rules;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function index(Request $request)
    {
        $orderBy = is_null($request->get('order_by')) ? 'id' : $request->get('order_by');
        $orderArr = explode(',', $orderBy);
        $sortBy = in_array($request->get('sort_by'), ['asc', 'desc']) ? $request->get('sort_by') : 'desc';
        $searchBy = $request->get('search_by');
        $searchText = $request->get('search_text');
        $data = User::query();
        foreach ($orderArr as $order) {
            $data = $data->orderBy($order, $sortBy);
        }
        if (!is_null($searchBy) && $this->checkColumn($searchBy)) {
            $data = $data->where($searchBy, 'LIKE', "%$searchText%");
        }

        return $data->paginate(self::PAGE_SIZE);
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return User::find($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    function store(Request $request)
    {
        if($request->has('avatar')){
            try{
                $userAvatarStorage = new UserAvatarStorage();
                $avatar = $userAvatarStorage->store($request->file('image'));
            } catch (FileExistsException $e) {
                throw $e;
            }
        } else {
            $avatar = '';
        }

        $active = is_null($request->get('active')) ? User::INACTIVE : User::ACTIVE;
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => $request->get('role_id'),
            'active' => $active,
            'avatar' => $avatar
        ]);

        return $user;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->has('image')){
            $userAvatarStorage = new UserAvatarStorage();
            $avatar = $userAvatarStorage->replace($user->avatar, $request->file('image'));
        } else {
            $avatar = $user->avatar;
        }

        $active = is_null($request->get('active')) ? User::INACTIVE : User::ACTIVE;
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => $request->get('role_id'),
            'active' => $active,
            'avatar' => $avatar
        ]);

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $user = User::find($id);
        if(!is_null($user))
            $user->delete();
    }
}
