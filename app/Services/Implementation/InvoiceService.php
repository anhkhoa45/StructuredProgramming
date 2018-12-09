<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 10:14
 */

namespace App\Services\Implementation;


use App\Services\InvoiceServiceInterface;
use App\Storage\LaravelImpl\UserAvatarStorage;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\FileExistsException;

class InvoiceService implements InvoiceServiceInterface
{
    const PAGE_SIZE = 6;

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
        ];
    }

    /**
     * Rules update.
     * @return array
     */
    public function rulesUpdate($id)
    {
        $rules = $this->rulesCreate();
//        $rules['password'] = 'nullable|confirmed|min:4';
        return $rules;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function index(Request $request)
    {
        $query = Invoice::where('user_id', '>',1);
        if($request->has('status') and $request->query('status')!="all"){
            $query = $query->where('status', 'LIKE', '%'.$request->query('status').'%');
        }
        if($request->has('daterange')){
            $start_data=date('Y-m-d h:i:s',strtotime(trim(explode("-", $request->query('daterange'))[0])));
            $end_data=date('Y-m-d h:i:s',strtotime(trim(explode("-", $request->query('daterange'))[1]. ' + 23 hours 59 minutes')));
            $query = $query->where('created_at', '>=',$start_data)->where('created_at', '<=',$end_data)->orderBy('created_at', 'asc');
        }
        else{
            $start_day=date('Y-m-d').' 00:00:00';
            $end_day =date('Y-m-d h:i:s',strtotime(date('Y-m-d'). ' + 23 hours 59 minutes'));
//            return $start_day.$end_day ;
            $query = $query->where('created_at', '>=',$start_day)->where('created_at', '<=',$end_day)->orderBy('created_at', 'asc');
        }
        $invoices = $query->paginate(self::PAGE_SIZE);
        return $invoices;
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return Invoice::find($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    function store(Request $request)
    {
//        $avatar = '';
//
//        if($request->hasFile('avatar')){
//            try{
//                $userAvatarStorage = new UserAvatarStorage();
//                $avatar = $userAvatarStorage->store($request->file('avatar'));
//            } catch (FileExistsException $e) {
//                throw $e;
//            }
//        }
//
//        $active = $request->has('active') ? $request->get('active') : User::INACTIVE;
//        $user = Invoice::create([
//            'name' => $request->get('name'),
//            'email' => $request->get('email'),
//            'password' => Hash::make($request->get('password')),
//            'role_id' => $request->get('role_id'),
//            'active' => $active,
//            'avatar' => $avatar
//        ]);
//
//        return $user;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        $invoice->update([
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
//            'delivered' => Hash::make($request->get('delivered')),
//            'paid' => $request->get('paid'),

        ]);

        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $invoice = Invoice::find($id);
        if(!is_null($invoice)){
            $transactions=$invoice->transactions;
            foreach($transactions as $transaction)
            {
                $transaction->delete();
            }
            $invoice->delete();
        }

    }
}
