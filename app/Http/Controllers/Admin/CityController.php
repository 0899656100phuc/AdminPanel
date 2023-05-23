<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CityController extends Controller
{
    public function index(){
        $citys = Citys::all();
        return view('admin.city.index')->with('citys', $citys);
    }
    public function create(){
        return view('admin.city.create-city');
    }
    public function store(Request $request){
        $city = new Citys;
        $city->name = $request->input('name');
        $city->sub_name = $request->input('sub_name');
        $city->image = $request->input('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('images/city'),$filename);
            $city->image = $filename;
            
        }

        $city->save();
       

        
        //sau khi luu xong chuyen trang
        return redirect('/city')->with('success','Thêm thành công');
    }
    public function editcity($id){
        $citys = Citys::findOrFail($id);
        

        return view('admin.city.edit-city')->with('citys', $citys);
    }
    public function update(Request $request , $id){
        $city = Citys::find($id);;
        $city->name = $request->input('name');
        $city->sub_name = $request->input('sub_name');
        $city->image = $request->input('image');
      
        
        if($request->hasFile('image')){
            $destination = public_path('images/city/').$city->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $finename = time().'.'.$extension;
            $file->move(public_path('images/city/'),$finename);
            $city->image = $finename;

        }
       
        
        $city->update();
        //sau khi luu xong chuyen trang
        return redirect('/city')->with('success','Cập nhật thành công');
    }
}
