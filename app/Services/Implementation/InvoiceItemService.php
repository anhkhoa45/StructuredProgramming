<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 22:32
 */


namespace App\Services\Implementation;


use App\Services\InvoiceItemServiceInterface;
use App\Storage\LaravelImpl\UserAvatarStorage;
use App\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\FileExistsException;

class InvoiceItemService implements InvoiceItemServiceInterface
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
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return InvoiceItem::find($id);
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
                $userAvatarStorage = new UserAvatarStorage();
                $avatar = $userAvatarStorage->store($request->file('avatar'));
            } catch (FileExistsException $e) {
                throw $e;
            }
        }

        $active = $request->has('active') ? $request->get('active') : User::INACTIVE;
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

        $avatar = $user->avatar;

        if($request->hasFile('avatar')){
            $userAvatarStorage = new UserAvatarStorage();
            $avatar = $userAvatarStorage->replace($user->avatar, $request->file('avatar'));
        }
        $active = $request->has('active') ? $request->get('active') : User::INACTIVE;
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
        $transaction = InvoiceItem::find($id);

        if(!is_null($transaction)){
            $product=$transaction->product;
            $product->quantity=$product->quantity+$transaction->quatity;
            $transaction->delete();
        }

    }
}
