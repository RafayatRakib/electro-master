<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactAndSocial;
use App\Models\LogonAndName;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;
use Svg\Tag\Rect;

class SettingController extends Controller{

    public function index(){
        return view('backend.pages.setting.setting');
    }//end method

    public function siteLogo(){
        $logo = LogonAndName::paginate(10);
       return view('backend.pages.setting.siteandlogo',compact('logo'));
    }//end method


    public function clearCache(){
        Artisan::call('cache:clear');
        session()->flash('success','Cache clear successed');
        return redirect()->back();
    }//end method

    public function logoandsiteStore(Request $request){
        $request->validate([
            'site_name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],
    [
        'site_name:requred' => 'Site name empty',
        'logo.required' => 'The logo field is required.',
        'logo.image' => 'The logo must be an image.',
        'logo.mimes' => 'The logo must be a file of type: :values.',
        'logo.max' => 'The logo must not exceed :max kilobytes.',
    ]);
    $logo = LogonAndName::where('status','active')->first();
    $logo->status = 'inactive';
    $logo->update();

    $LogonAndName = new LogonAndName();
    $LogonAndName->name = $request->site_name;

    if($request->hasFile('logo')){
        $file = $request->file('logo');
        $newName =  uniqid().'.'.$file->getClientOriginalExtension();
            $path = public_path('uploads/logo/'.$newName);
            Image::make($file)->resize(169,70)->save($path);
            $LogonAndName->logo = 'uploads/logo/'.$newName;
        }
    $LogonAndName->save();
    session()->flash('success','logo and site name added');
    return redirect()->back();
    }//end method

    public function logoSiteEdit($id){
        $logo = LogonAndName::findOrFail($id);
        return view('backend.pages.setting.editSiteandlogo',compact('logo'));
    }//end method

    public function logoSiteUpdate(Request $request){
        // dd($request->logo_name_id);
        $request->validate([
            'site_name' => 'required',
        ],
    [
        'site_name:requred' => 'Site name empty',
        'logo.required' => 'The logo field is required.',
        'logo.image' => 'The logo must be an image.',
        'logo.mimes' => 'The logo must be a file of type: :values.',
        'logo.max' => 'The logo must not exceed :max kilobytes.',
    ]);

    $LogonAndName = LogonAndName::findOrFail($request->logo_name_id);
    $LogonAndName->name = $request->site_name;

    if($request->hasFile('logo')){
      
        unlink($LogonAndName->logo);
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
        ]);
        $file = $request->file('logo');
        $newName =  uniqid().'.'.$file->getClientOriginalExtension();
            $path = public_path('uploads/logo/'.$newName);
            Image::make($file)->resize(169,70)->save($path);
            $LogonAndName->logo = 'uploads/logo/'.$newName;
            $LogonAndName->updated_at = Carbon::now();
        }
    $LogonAndName->update();
    session()->flash('success','logo and site updated');
    return redirect()->route('admin.site.logo');
    }//end method

    public function logoSiteDelete(Request $request){
        $howManyLogo =  LogonAndName::all();
        // dd(count($howManyLogo));
        if(count($howManyLogo)==1){
        session()->flash('error','logo and site not deleted, becouse it is ony one data in a recorde');
        return redirect()->route('admin.site.logo');
        }
        $logo = LogonAndName::findOrFail($request->delete_id);
        unlink($logo->logo);
        $logo->delete();
        session()->flash('error','logo and site deleted');
        return redirect()->route('admin.site.logo');
    }//end method

    public function logoSiteStatus($id){
        

        $logo = LogonAndName::findOrFail($id);

        if($logo->status == 'active'){
            $logo->status = 'inactive';
            $logo->update();
            session()->flash('error','logo and site inactive');
            return redirect()->route('admin.site.logo');
        }else{
            $logo->status = 'active';
            $logo->update();
            session()->flash('success','logo and site actived');
            return redirect()->route('admin.site.logo');
        }

    }//end method

    //---------------------------------------------------------------
    public function socialContact(){
        return view('backend.pages.setting.socialContact');
    }//end method

    public function socialContactStore(Request $request){

        $request->validate([
            'address' => 'required|max:50',
            'phone_1' => 'required|min:11|max:11',
            'email_1' => 'required|email',
            'phone_2' => 'nullable|min:11|max:11',
            'email_2' => 'nullable|email',
            'map_link' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $socialAndContact = new ContactAndSocial();
        $socialAndContact->phone_one = $request->phone_1;
        if($request->phone_2){
            $socialAndContact->phone_two = $request->phone_2;
        }
        $socialAndContact->email_one = $request->email_1;
        if($request->email_2){
            $socialAndContact->email_two = $request->email_2;
        }
        $socialAndContact->address = $request->address;
        if($request->map_link){
            $socialAndContact->map_link = $request->map_link;
        }
        if($request->facebook){
            $socialAndContact->facebook_url = $request->facebook;
        }
        if($request->twitter){

            $socialAndContact->twitter_url = $request->twitter;
        }
        if($request->instagram){
            $socialAndContact->instagram_url = $request->instagram;
        }
        if($request->youtube){
            $socialAndContact->youtube_url = $request->youtube;
        }

        // $contact = ContactAndSocial::where('status','active')->first();
        // if($contact){
        //     $contact->status = 'inactive';
        //     $contact->update();
        // }
        $socialAndContact->save();

        session()->flash('success','Contact added succesfuly');
        return redirect()->route('all.socialandcontact');
    }//end method

    public function allsocialandcontact(){
        $contact = ContactAndSocial::latest()->paginate();
        return view('backend.pages.setting.allsocialContact',compact('contact'));
    }// end method

    public function socialContactEdit($id){
        $contact = ContactAndSocial::findOrFail($id);
        return view('backend.pages.setting.editsocialContact',compact('contact'));
    }//end method

    public function socialContactUpdate(Request $request){
        $request->validate([
            'address' => 'nullable|max:50',
            'phone_1' => 'nullable|min:11|max:11',
            'email_1' => 'nullable|email',
            'phone_2' => 'nullable|min:11|max:11',
            'email_2' => 'nullable|email',
            'map_link' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);
        

        
        $socialAndContact = ContactAndSocial::findOrfail($request->contact_id);
        if($request->phone_1){
            $socialAndContact->phone_one = $request->phone_1;
        }
        if($request->phone_2){
            $socialAndContact->phone_two = $request->phone_2;
        }
        if($request->email_1){
            $socialAndContact->email_one = $request->email_1;
        }
        if($request->email_2){
            $socialAndContact->email_two = $request->email_2;
        }
        if($request->address){
            $socialAndContact->address = $request->address;
        }
        if($request->map_link){
            $socialAndContact->map_link = $request->map_link;
        }
        if($request->facebook){
            $socialAndContact->facebook_url = $request->facebook;
        }
        if($request->twitter){
            $socialAndContact->twitter_url = $request->twitter;
        }
        if($request->instagram){
            $socialAndContact->instagram_url = $request->instagram;
        }
        if($request->youtube){
            $socialAndContact->youtube_url = $request->youtube;
        }
        
        // $contact = ContactAndSocial::where('status','active')->first();
        // if($contact){
        //     $contact->status = 'inactive';
        //     $contact->update();
        // }
        $socialAndContact->updated_at = Carbon::now();
        $socialAndContact->update();
        session()->flash('success','Contact updated successfully');
        return redirect()->route('all.socialandcontact');
    }//end method

    public function contact_delete(Request $request){
        // $delete = ContactAndSocial::findOrFail($request->deleted_id)->delete();
        session()->flash('error','Contact deleted successfully');
        return redirect()->route('all.socialandcontact');
    }//end method

    public function contact_status($id){
        $contact = ContactAndSocial::findOrFail($id);
        // $isanyactive = ContactAndSocial::where('status','active')->count();
        // if($isanyactive<1){
        //     session()->flash('error','minimum one row need to deactive');
        //     return redirect()->route('all.socialandcontact');
       
        // }
        if($contact->status == 'active'){
            $contact->status = 'inactive';
            $contact->update();
            session()->flash('error','Contact deactived successfully');
            return redirect()->route('all.socialandcontact');
        }else{
            $contact->status = 'active';
            $contact->update();
            session()->flash('success','Contact actived successfully');
            return redirect()->route('all.socialandcontact');
            
        }
    }//end method 


}