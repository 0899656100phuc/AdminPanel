<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\ImageRoom;
use App\Models\Room;
use App\Models\ServiceRoom;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use File;
class RoomController extends Controller
{
    public function index(){
        $hotel = Hotel::get();
        $room = Room::all();
        return view('admin.room.index',['rooms'=> $room,'hotels'=> $hotel]);
    }
    public function editRoom($id){
        $typeroom = TypeRoom::get();
        $hotel = Hotel::get();
        $room = Room::findOrFail($id);
        return view('admin.room.edit-room',['rooms'=> $room,'hotels'=> $hotel,'typeRoom'=> $typeroom]);
    }
    public function create(){
        $hotel = Hotel::get();
        $typeroom = TypeRoom::get();
        return view('admin.room.create-room', ['hotels' => $hotel, 'typerooms' => $typeroom]);
    }
    public function store(Request $request){
        $room = new Room;
        $room->name = $request->input('name');
        $room->hotel_id = $request->input('hotel');
        $room->type_room_id = $request->input('typeroom');
        $room->description = $request->input('description');
        $room->status = $request->input('status');
        $room->save(); // Save the room record first to get the ID
    
        if($request->hasFile('images')){
            $files = $request->file('images');
            foreach($files as $image){
                $imageName = time().'.'.$image->getClientOriginalName();
                $imageData = [
                    'room_id' => $room->id, // Set the room_id to the saved room's ID
                    'image' => $imageName,
                ];
                $image->move(public_path('images/room'),$imageName);
                ImageRoom::create($imageData);
            }
        }
        $inputs = $request->input('inputs');
        foreach ($inputs as $input) {
            $name = $input['name_service'];
            $service = new ServiceRoom(['name' => $name]);
            $room->services()->save($service);

        }
        //sau khi luu xong chuyen trang
        return redirect('/rooms')->with('success','Thêm thành công');
    }
     public function update(Request $request , $id){
        
        $room = Room::find($id);
        $room->name = $request->input('name');
        $room->hotel_id = $request->input('hotel');
        $room->type_room_id = $request->input('typeroom');
        $room->description = $request->input('description');
        $room->status = $request->input('status');
        $room->update();
       
        if($request->hasFile('images')){
            $file = $request->file('images');
            foreach($file as $image){
                $imageName = time().'.'.$image->getClientOriginalName();
                $imageData = [
                    'room_id' => $room->id, // Set the room_id to the saved room's ID
                    'image' => $imageName,
                ];
                $image->move(public_path('images/room/'),$imageName);
                ImageRoom::create($imageData);
            }
        }
        $inputs = $request->input('inputs');
        foreach ($inputs as $input) {
            if (isset($input['id'])) {
                $service = ServiceRoom::find($input['id']);
                $service->name = $input['name_service'];
                $service->save();
            } else {
                $service = new ServiceRoom();
                $service->name = $input['name_service'];
                $service->room_id = $room->id;
                $service->save();
            }
        }
        //sau khi luu xong chuyen trang
        return redirect('/rooms')->with('success','Cập nhật thành công');
    }
    
    public function deleteimage($id){
       

        $images = ImageRoom::find($id);
        
        if(File::exists("images/room/".$images->image)){
            File::delete("images/room/".$images->image);

        }
        ImageRoom::find($id)->delete();
        return back();
    }
    public function deleteService($id)
    {
        $service = ServiceRoom::find($id);
        $service->delete();
    
        return redirect()->back()->with('success', 'Service deleted successfully');
    }
}
