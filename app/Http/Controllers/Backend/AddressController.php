<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AddressController extends Controller
{
    public function allDivision(){
        $division = Division::paginate(10);
        return view('backend.pages.address.division.all_division',compact('division'));
    }//end method


    public function AddDivision(){
        return view('backend.pages.address.division.add_division');

    }//end method

    public function DivisonStore(Request $request){
        // dd($request);
        $request->validate([
            'division' => 'required',
            // 'delivery_charge' => 'required',
        ]);

        Division::insert([
            'division_name' => $request->division,
            // 'delivery_charge' => $request->delivery_charge,
            'created_at' => Carbon::now(),
        ]);

        session()->flash('success','Division added successfuly');
        return redirect()->route('admin.all.division');
    }//end method

    public function DivisionEdit($id){
        $division = Division::findOrFail($id);
        return view('backend.pages.address.division.edit',compact('division'));
    }//end method

    public function DivisionUpdate(Request $request){
        Division::findOrFail($request->division_id)->update([
            'division_name' => $request->division,
            'delivery_charge' => $request->delivery_charge,
            'updated_at' => Carbon::now(),
        ]);
        session()->flash('success','Division updated successfuly');
        return redirect()->route('admin.all.division');
    }//end method

    public function DivisionDelete(Request $request){
        Division::findOrFail($request->delete_id)->delete();
        session()->flash('error','Division updated successfuly');
        return redirect()->route('admin.all.division');
    }//end method

    public function divisionStatus($id){
        $division = Division::findOrFail($id);
        if($division->status == '1'){
            $division->status = 0;
            $division->update();
            session()->flash('error','Division deactived');
            return redirect()->route('admin.all.division');
        }else{
            $division->status = 1;
            $division->update();
            session()->flash('success','Division actived');
            return redirect()->route('admin.all.division');
        }
        
    }//end method

    //-----------------------------------------------------------------------------------------------------------

    public function allDistrict(){
        $district = District::paginate(10);
        return view('backend.pages.address.district.all_district',compact('district'));
    }//end method


    public function AddDistrict(){
        $division =  Division::where('status','1')->get();
        return view('backend.pages.address.district.add_district',compact('division'));

    }//end method

    public function DistrictStore(Request $request){

        $request->validate([
            'district' => 'required',
            'delivery_charge' => 'required',
            'division' => 'required',
        ]);

        District::insert([
            'division_id' => $request->division,
            'district_name' => $request->district,
            'delivery_charge' => $request->delivery_charge,
            'created_at' => Carbon::now()
        ]);

        session()->flash('success','District added successfuly');
        return redirect()->route('admin.all.district');
    }//end method

    public function DistrictEdit($id){
        $district = District::findOrFail($id);
        return view('backend.pages.address.district.edit',compact('district'));
    }//end method

    public function DistrictUpdate(Request $request){
        District::findOrFail($request->district_id)->update([
            'division_name' => $request->division,
            'delivery_charge' => $request->delivery_charge,
            'updated_at' => Carbon::now(),
        ]);
        session()->flash('success','Division updated successfuly');
        return redirect()->route('admin.all.district');
    }//end method

    public function DistrictDelete(Request $request){
        Division::findOrFail($request->delete_id)->delete();
        session()->flash('error','Division updated successfuly');
        return redirect()->route('admin.all.district');
    }//end method

    public function districtStatus($id){
        $division = Division::findOrFail($id);
        if($division->status == '1'){
            $division->status = 0;
            $division->update();
            session()->flash('error','Division deactived');
            return redirect()->route('admin.all.district');
        }else{
            $division->status = 1;
            $division->update();
            session()->flash('success','District actived');
            return redirect()->route('admin.all.district');
        }
        
    }//end method

    //-----------------------------------------------------------------------------------------------------------

    public function allUpazila(){
        $upazila = Upazila::paginate(10);
        return view('backend.pages.address.upazila.all_upazila',compact('upazila'));
    }//end method


    public function AddUpazila(){
        $district =  District::where('status','1')->get();
        return view('backend.pages.address.upazila.add_upazila',compact('district'));

    }//end method

    public function UpazilaStore(Request $request){

        $request->validate([
            'district' => 'required',
            'upazila' => 'required',
        ]);

        Upazila::insert([
            'district_id' => $request->district,
            'upazila_name' => $request->upazila,
            'created_at' => Carbon::now()
        ]);

        session()->flash('success','Upazila added successfuly');
        return redirect()->route('admin.all.upazila');
    }//end method

    public function UpazilaEdit($id){
        $upazila = Upazila::findOrFail($id);
        $district = District::where('status','1')->get();
        return view('backend.pages.address.upazila.edit_upazila',compact('upazila','district'));
    }//end method

    public function UpazilaUpdate(Request $request){
        Upazila::findOrFail($request->upazila_id)->update([
            'district_id' => $request->district,
            'upazila_name' => $request->upazila,
            'updated_at' => Carbon::now()
        ]);
        session()->flash('success','Upazila updated successfuly');
        return redirect()->route('admin.all.upazila');
    }//end method

    public function UpazilaDelete(Request $request){
        Upazila::findOrFail($request->delete_id)->delete();
        session()->flash('error','Upazila updated successfuly');
        return redirect()->route('admin.all.upazila');
    }//end method

    public function upazilaStatus($id){
        $upazila = Upazila::findOrFail($id);
        if($upazila->status == '1'){
            $upazila->status = 0;
            $upazila->update();
            session()->flash('error','Upazila deactived');
            return redirect()->route('admin.all.upazila');
        }else{
            $upazila->status = 1;
            $upazila->update();
            session()->flash('success','Upazila actived');
            return redirect()->route('admin.all.upazila');
        }
        
    }//end method















}
