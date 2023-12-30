<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Pages;
use Carbon\Carbon;
use Dompdf\FrameDecorator\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PagesController extends Controller
{
    public function AllPage(){
        $pages = Pages::orderBy('id','desc')->get();
        return view('backend.pages.pages.all',compact('pages'));
    }//end method

    public function AddPages(){
        return view('backend.pages.pages.add');
    }//end method

    public function StorePage(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'content' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $page = new Pages();
        $page->title = $request->title;
        $page->meta_title = $request->meta_title;
        $page->slug = strtolower(str_replace(" ", "-",$request->title));
        $page->meta_description = $request->meta_description;
        $page->content = $request->content;
        $page->status = $request->status;
        $page->created_at = Carbon::now();
        $page->save();
        toast('Page created successfuly','success');
        return redirect()->route('admin.all.page');
        

    }//end method

    public function EditPage($id){
        $page = Pages::findOrFail($id);
        return view('backend.pages.pages.edit',compact('page'));
    }//end method


    public function UpdatePage(Request $request){
        $page = Pages::findOrFail($request->page_id);
        if($request->title){
          $page->title = $request->title;
        }
        if($request->meta_title){
          $page->meta_title = $request->meta_title;
        }
        if($request->title){
          $page->slug = strtolower(str_replace(" ", "-",$request->title));
        }
        if($request->meta_description){
          $page->meta_description = $request->meta_description;
        }
        if($request->content){
          $page->content = $request->content;
        }
        if($request->status){
          $page->status = $request->status;
        }
        $page->updated_at = Carbon::now();
        $page->Update();
        toast('Page updated successfuly','success');
        return redirect()->route('admin.all.page');
    }//end method

    public function pageDelete(Request $request){
        Pages::findOrFail($request->deleted_id)->delete();
        toast('Page deleted successfuly','success');
        return redirect()->back();
    }//end method


}
