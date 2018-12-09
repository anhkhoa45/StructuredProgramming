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
use App\Storage\UserAvatarStorageInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\FileExistsException;

class UserService implements UserServiceInterface
{
    const PAGE_SIZE = 8;

    protected $userAvatarStorage;

    public function __construct(UserAvatarStorageInterface $userAvatarStorage)
    {
        $this->userAvatarStorage = $userAvatarStorage;
    }

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
        $rules['password'] = 'nullable|confirmed|min:4';
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
        if (!is_null($searchBy)) {
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
        $avatar = '';

        if($request->hasFile('avatar')){
            try{
                $avatar = $this->userAvatarStorage->store($request->file('avatar'));
            } catch (FileExistsException $e) {
                throw $e;
            }
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => $request->get('role_id'),
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

        $avatar = $user->avatar;

        if($request->hasFile('avatar')){
            $avatar = $this->userAvatarStorage->replace($user->avatar, $request->file('avatar'));
        }

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->has('password') ? Hash::make($request->get('password')) : null,
            'role_id' => $request->has('role_id') ? $request->get('role_id') : User::ROLE_USER,
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

    /**
     * Count user
     * @return user number
     */
    public function count(){
        return User::count();
    }
}
