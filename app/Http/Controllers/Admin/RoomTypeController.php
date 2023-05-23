<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeRoom;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index(){
        $typeroom = TypeRoom::get();
        return view('admin.type_room.index')->with('typerooms', $typeroom);
    }
    public function create(){
        return view('admin.type_room.create-typeroom');
    }
    public function store(Request $request){
        $typeroom = new TypeRoom;
    
        $typeroom->name = $request->input('name');
        $typeroom->price = $request->input('price');
        $typeroom->area = $request->input('area');
        $typeroom->number_of_people = $request->input('number_of_people');
        $typeroom->number_of_bed = $request->input('number_of_bed');

        $typeroom->save();
        //sau khi luu xong chuyen trang
        return redirect('/type-room')->with('success','Thêm thành công');
    }
}
