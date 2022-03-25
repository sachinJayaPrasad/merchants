<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Merchants;
use App\Models\Location;

class MerchantsController extends Controller
{
    public function show(Request $request)
    {
        $data['merchants'] = Merchants::get();
        return view('merchants.home',$data);
    }
    public function show_add_page(Request $request)
    {
        return view('merchants.add_new');
    }
     //Edit function
    public function edit_merchant($_id)
    {
        if ($_id) {
            $data['merchants'] = Merchants::find($_id);
            $data['locations']  = Location::where('merchant_id',$_id)->get();
            return view('merchants.edit',$data);
        } else {
            return response()->json(['status' => true, 'response' => 'Something went wrong']);
        }
    }
    public function add_merchants(Request $request)
    {
         try{
            $rules = [
                'name'     => 'required',
                'email'    => 'required',
                'phone'    => 'required',
                'address'  => 'required',
            ];
            $messages = [
                'name.required'     => 'Shop Name is required',
                'email.required'    => 'Email is required',
            ];
            $validation = Validator::make($request->all(),$rules,$messages);
            if($validation->fails()){
                return response()->json(['status'=>0,'response'=>$validation->errors()->all()]);
            }
            $merchants = new Merchants();
            $merchants->shop_name  = $request->name;
            $merchants->email      = $request->email;
            $merchants->phone      = $request->phone;
            $merchants->address    = $request->address;
            $merchants->save();
            // Getting the last inserted id
            $merchant_id = $merchants->id;
            // Inserting locations to seperate collection using the last inserted id
            foreach ($request->location as $key=>$loc) {
                $locations              = new Location();
                $locations->name        = $loc;
                $locations->merchant_id = $merchant_id;
                $locations->save();
            }
            return redirect('/merchants');
        }catch(\Exception $e){
            return response()->json(['status'=>0,'response'=>[$e->getMessage()]]);
        }
    }
    public function update_merchants(Request $request,$_id)
    {
         try{
            $rules = [
                'name'     => 'required',
                'email'    => 'required',
                'phone'    => 'required',
                'address'  => 'required',
            ];
            $messages = [
                'name.required'     => 'Shop Name is required',
                'email.required'    => 'Email is required',
            ];
            $validation = Validator::make($request->all(),$rules,$messages);
            if($validation->fails()){
                return response()->json(['status'=>0,'response'=>$validation->errors()->all()]);
            }
            $merchants = Merchants::find($_id);
            $merchants->shop_name  = $request->name;
            $merchants->email      = $request->email;
            $merchants->phone      = $request->phone;
            $merchants->address    = $request->address;
            $merchants->save();
            // Getting the last inserted id
            $merchant_id = $merchants->id;
            //Deleting entire row in table and adding new
            Location::where('merchant_id',$merchant_id)->delete();
            // Inserting location to seperate collection using the last inserted id
            foreach ($request->location as $key=>$loc) {
                $locations              = new Location();
                $locations->name        = $loc;
                $locations->merchant_id = $merchant_id;
                $locations->save();
            }
            return redirect('/merchants');
        }catch(\Exception $e){
            return response()->json(['status'=>0,'response'=>[$e->getMessage()]]);
        }
    }
    public function delete_location(Request $request){
        $id = $request->post('id');
        Location::where('id', $id)->delete();
    }
    //Delete function
    public function delete_merchant(Request $request){
        if($request->id){
            $location  = Location::where('merchant_id',$request->id)->delete();
            $merchants = Merchants::find($request->id)->delete();
            return redirect('/merchants');
        }else{
            return response()->json(['status'=>false,'response'=>'Something went wrong']);
        }
    }
}
