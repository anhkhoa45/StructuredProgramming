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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\FileExistsException;
use Illuminate\Support\Facades\DB;
use App\Invoice;
use App\User;

class InvoiceService implements InvoiceServiceInterface
{
    const PAGE_SIZE = 8;

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

    /**
     * Count total invoice
     * @return total invoice num
     */
    function count() {
        return Invoice::count();
    }
    
    /**
     * Count total ordered invoice by month (from Jan -> Dec)
     * @return Invoice
     */
    function getMonthlyOrderedInvoiceNum() {
        return Invoice::select(DB::raw('count(*) as ordered_invoice_num'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->whereYear('created_at', '=', 2018)
            ->groupby('year', 'month')
            ->get();
    }

    /**
     * Count total paid invoice by month (from Jan -> Dec)
     * @return Invoice
     */
    function getMonthlyPaidInvoiceNum() {
        return Invoice::select(DB::raw('count(*) as paid_invoice_num'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->whereYear('created_at', '=', 2018)
            ->where('paid', '=', 1)
            ->groupby('year', 'month')
            ->get();
    }

    /**
     * Return a number of lastest invoices
     * @param $num number of invoices want to get
     * @return Invoice
     */
    function getLatestInvoices($num) {
        return Invoice::orderBy('created_at','desc')->take($num)->get();
    }

    /**
     * Monthly revenue from January to December
     * @return Invoice
     */
    function getMonthlyRevenue() {
        return Invoice::select(DB::raw('sum(total) as total_amount'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->whereYear('created_at', '=', 2018)
            ->groupBy('year', 'month')
            ->get();
    }
}
