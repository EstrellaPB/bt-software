<?php

namespace publicity\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use publicity\Http\Controllers\Controller;
use publicity\Customer;
use publicity\CustomerProfile;
use publicity\Coupon;

class CustomerController extends Controller
{
    public function index(Request $request){

        return view('admin.customers.index');
        // return response($request->input());

    }

    public function getCustomers(Request $request){
        //return response()->json($request->header());
        $customers = Customer::with('customerProfile')->get();
        
        $view = view('admin.customers.table', [
            "customers" => $customers
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }
    public function getCustomerCoupons($id){
        $coupons = Coupon::where('id_customer', $id)->get();
        $view = view('admin.customers.tableCustomerCoupons', [ 
            "coupons" => $coupons
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function deleteCustomerCoupon($id){
        $result['response'] = 'error';

        if($coupon = Coupon::findOrFail($id)){
           
            if($coupon->delete()){
                // Session::flash('deleteCustomerCoupon', 'Se ha eliminado el cupón correctamente');
                $result['response'] = 'success';
                $result['message'] = 'Se ha eliminado el cupón correctamente';

            }else{
               $result['message'] = 'Hubo un error al eliminar el cupón'; 
            }
        }
        else{
            //Session::flash('errorCustomer', 'No se ha encontrado el cupón');
            $result['message'] = 'No se ha encontrado el cupón';
        }

       // return redirect('admin/customer/');
        return response()->json($result);
    }
    public function show($id, Request $request){

        $result['response'] = 'error';

        if($customer = Customer::find($id)){

            $result['response'] = 'success';
            $customer = Customer::find($id);
            $view = view('admin.customers.show', [
                'customer' => $customer
            ]);

            $result['data'] = $customer;
            $result['data']['view'] = $view->render();
        }

        return response()->json($result);

    }

    public function edit($id, Request $request){
        $result['response'] = 'error';

        if($customer = Customer::find($id)){

            $table = view('admin.customers.tableCounter', [
                "couponsUsed" => $customer->coupons->where('used', 1)->count(),
                "coupons" => $customer->coupons->count()
            ]);

            $result['response'] = 'success';
            $result['data'] = $customer;
            $result['data']['table'] = $table->render();

            $result['data']['name'] = $customer->name;
            $result['data']['email'] = $customer->email;

            if($customer->customerProfile){
            	$result['data']['first_name'] = $customer->customerProfile->first_name;
	            $result['data']['last_name'] = $customer->customerProfile->last_name;
	            $result['data']['address'] = $customer->customerProfile->address;
	            $result['data']['tel'] = $customer->customerProfile->tel;
	            $result['data']['city'] = $customer->customerProfile->city;
	            $result['data']['state'] = $customer->customerProfile->state;
            }
            
        }

        return response()->json($result);
    }

    public function update($id, Request $request){
        $result['response'] = 'error';
        
        $customer = Customer::find($id);
        if(!$customer)
            return response()->json($result);

        $customer->email = $request->input('email');
        $customer->name = $request->input('name');

        if($customer->customerProfile){
        	$customer->customerProfile->first_name = $request->input('first_name');
	        $customer->customerProfile->last_name = $request->input('last_name');
	        $customer->customerProfile->address = $request->input('address');
	        $customer->customerProfile->tel = $request->input('tel');
	        $customer->customerProfile->city = $request->input('city');
	        $customer->customerProfile->state = $request->input('state');

	        $customer->customerProfile->update();
        }else{
        	$profile = new CustomerProfile;

        	$profile->first_name = $request->input('first_name');
        	$profile->last_name = $request->input('last_name');
	        $profile->address = $request->input('address');
	        $profile->tel = $request->input('tel');
	        $profile->city = $request->input('city');
	        $profile->state = $request->input('state');

	        $profile->id_customer = $customer->id;

	        $profile->save();
        }
        

        if($customer->update()){
        	Session::flash('updateCustomer', 'Se ha actualizado el usuario ' . $customer->id . "-" . $customer->name );
        }else{
        	Session::flash('errorCustomer', 'Hubo un error al actualizar el usuario');
        }  
        
        $result["data"] = $customer;

        return redirect('admin/customer/');
    }

    public function destroy($id, Request $request){
         if($customer = Customer::findOrFail($id)){

            if($customerProfile = $customer->customerProfile){

	                $customerProfile->delete();

            }

            if($customer->delete()){
                Session::flash('deleteCustomer', 'Se ha eliminado el usuario correctamente');
            }else{
                Session::flash('errorCustomer', 'Ha ocurrido un error al eliminar el usuario');
            }

            
        }else{
            Session::flash('errorCustomer', 'No se ha encontrado el usuario');
        }

        return redirect('admin/customer/');
    }

    public function store(Request $request){
        
        $customer = Customer::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'name' => $request->input('name'),
        ]);

        if($customer){
        	$profile = new CustomerProfile;

        	$profile->first_name = $request->input('first_name');
        	$profile->last_name = $request->input('last_name');
	        $profile->address = $request->input('address');
	        $profile->tel = $request->input('tel');
	        $profile->city = $request->input('city');
	        $profile->state = $request->input('state');

	        $profile->id_customer = $customer->id;

	        $profile->save();

	        Session::flash('storeCustomer', 'Se ha agregado un nuevo usuario');
        }

        
        
        $result["data"] = $customer;
        return redirect('admin/customer/');
    }
}
