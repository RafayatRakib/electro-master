<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Employ;
use App\Models\EmployRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Svg\Tag\Rect;
use Intervention\Image\Facades\Image;

class EmployController extends Controller
{

    public function EmployerRole(){
        $role = EmployRole::paginate(20);
        return view('backend.pages.employ.role',compact('role'));
    }//end method

    public function EmployerRoleStore(Request $request){
        // dd($request);
        $request->validate([
            'role' => 'required',
            'salary' => 'required'
        ]);

        EmployRole::insert([
            'role' => $request->role,
            'salary' => $request->salary,
            'status' => 'active',
            'created_at'=> Carbon::now(),
        ]);
        session()->flash('success','Role added successfuly');
        return redirect()->back();

    }//end method

    public function roleStatus($id){
        $role = EmployRole::findOrFail($id);
        if($role->status == 'active'){
        $role->status = 'inactive';
        $role->update();
        session()->flash('error','Role status change');
        return redirect()->back();
        }else{
        $role->status = 'active';
        $role->update();
        session()->flash('success','Role status change');
        return redirect()->back();
        }
    }//end method
    public function RoleEdit($id){
        $role = EmployRole::findOrFail($id);
        return view('backend.pages.employ.edit_role',compact('role'));
    }//end method

    public function RoleUpdate(Request $request){
        $request->validate([
            'role' => 'required',
            'salary' => 'required'
        ]);

        EmployRole::findOrFail($request->update_id)->update([
            'role' => $request->role,
            'salary' => $request->salary,
            'updated_at'=> Carbon::now(),
        ]);
        session()->flash('success','Role updated  successfuly');
        return redirect()->route('role.employer');
    }//end method

    public function roleDeleted(Request $request){
        EmployRole::findOrFail($request->delete_id)->delete();
        session()->flash('error','Role deleted successfuly');
        return redirect()->route('role.employer');
    }//end method

    // --------------------------------------------------------------------------

    public function allActiveEmployer(){
        // $employers = Employ::with('em_role')->paginate(15);
        $employers = Employ::with('RoleName')->where('status','active')->paginate();
        return view('backend.pages.employ.allActiveEmployer',compact('employers'));

    }// end method


    public function addEmployer(){
        $role = EmployRole::where('status','active')->get();
        return view('backend.pages.employ.addEmploy',compact('role'));
    }// end method

    public function StoreEmployer(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required',
            'nid' => 'required',
            'Phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'role' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);

        $employer = new Employ();
        $employer->name = $request->name;
        $employer->nid = $request->nid;
        $employer->phone =  $request->Phone;
        $employer->email = $request->email;
        $employer->address = $request->address;
        $employer->date_of_birth = $request->date_of_birth;
        $employer->role_id = $request->role;
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/employ/'.$newName;
            Image::make($file)->resize(300, 300)->save($path);
        $employer->photo = $path;
        }
        $employer->save();
        session()->flash('success','Employer addes succesfully');
        return redirect()->route('active.employer');

    }//end method

    public function employStatus($id){
        $employer = Employ::findOrFail($id);
        if($employer->status=='active'){
            $employer->status = 'inactive';
            $employer->updated_at = Carbon::now();
            $employer->update();
            session()->flash('error','Status inactive');
            return redirect()->back();
        }else{
            $employer->status = 'active';
            $employer->updated_at = Carbon::now();
            $employer->update();
            session()->flash('success','Status actived');
            return redirect()->back();
        }
    }//end methdo

    public function allEmployer(){
        $employers = Employ::paginate(15);
        return view('backend.pages.employ.allEmployer',compact('employers'));
    }//end method

    public function employEdit($id){
        $employer = Employ::findOrFail($id);
        $role = EmployRole::where('status','active')->get();
        return view('backend.pages.employ.editEmploy',compact('employer','role'));
    }//end method

    public function updateEmployer(Request $request){
        $request->validate([
            'name' => 'required',
            'nid' => 'required',
            'Phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'role' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);

        $employer = Employ::findOrFail($request->update_id);
        if($request->name){
            $employer->name = $request->name;
        }
        if($request->nid){
            $employer->nid = $request->nid;
        }
        if($request->Phone){
            $employer->phone =  $request->Phone;
        }
        if($request->email){
            $employer->email = $request->email;
        }
        if($request->address){
            $employer->address = $request->address;
        }
        if($request->date_of_birth){
            $employer->date_of_birth = $request->date_of_birth;
        }
        if($request->role){
            $employer->role_id = $request->role;
        }

        if($request->hasFile('photo')){
            unlink($employer->photo);
            $file = $request->file('photo');
            $newName = uniqid().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/employ/'.$newName;
            Image::make($file)->resize(300, 300)->save($path);
        $employer->photo = $path;
        }
        $employer->updated_at =  Carbon::now();
        $employer->update();
        session()->flash('success','Employer update succesfully');
        return redirect()->route('all.employer');
    }//end method

    public function employDetails($id){
        $employer = Employ::findOrFail($id);
        return view('backend.pages.employ.employDetails',compact('employer'));
    }//end method

    public function employDelete(Request $request){
        Employ::findOrFail($request->delete_id)->delete();
        session()->flash('error','Employer deleted succesfully');
        return redirect()->back();
    }//end method

    public function salaryEmployer(){
        $employer = Employ::where('status','active')->get();
        return view('backend.pages.employ.salary',compact('employer'));
    }// end method


}
