<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use App\Models\Hotel;
use App\Models\ImageHotel;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{

    public function index()
    {
        $hotel = Hotel::all();
        return view('admin.hotel.index')->with('hotels', $hotel);
    }
    public function create()
    {
        $citys = Citys::get();

        return view('admin.hotel.create-hotel')->with('citys', $citys);
    }
    public function store(Request $request)
    {

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/hotel'), $imageName);

            $hotel = new Hotel;
            $hotel->city_id = $request->input('city');
            $hotel->name = $request->input('name');
            $hotel->address = $request->input('address');
            $hotel->phone = $request->input('phone');
            $hotel->email = $request->input('email');
            $hotel->star_number = $request->input('star_number');
            $hotel->description = $request->input('description');
            $hotel->image = $imageName;
            $hotel->save();
        }
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            foreach ($file as $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $request['hotel_id'] = $hotel->id;
                $request['image'] = $imageName;
                $image->move(public_path('images/hotel'), $imageName);
                ImageHotel::create($request->all());
            }
        }

        $inputs = $request->input('inputs');
        foreach ($inputs as $input) {
            $name = $input['name_service'];
            $service = new Service(['name' => $name]);
            $hotel->services()->save($service);
        }

        //sau khi luu xong chuyen trang
        return redirect('/hotel')->with('success', 'Thêm thành công');
    }


    public function edithotel($id)
    {
        $hotels = Hotel::findOrFail($id);


        return view('admin.hotel.edit-hotel')->with('hotels', $hotels);
    }
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $destination = public_path('images') . $hotel->image;

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $images = ImageHotel::where("id", $hotel->id)->get();
        foreach ($images as $image) {
            if (File::exists("images/hotel" . $image->image)) {
                File::delete("images/hotel" . $image->image);
            }
        }

        if ($hotel) {
            $hotel->delete();
            return redirect('/hotel')->with('success', 'Xóa thành công');
        } else {
            return redirect('/hotel')->with('success', 'Không tìm thấy ID');
        }
    }


    public function update(Request $request, $id)
    {

        $hotel = Hotel::find($id);
        if ($request->hasFile('cover_image')) {
            $destination = public_path('images/hotel/') . $hotel->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalName();
            $finename = time() . '.' . $extension;
            $file->move(public_path('images/hotel/'), $finename);
            $request['cover_image'] = $finename;
        } else {
            $request['cover_image'] = $hotel->image;
        }

        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->phone = $request->input('phone');
        $hotel->email = $request->input('email');
        $hotel->star_number = $request->input('star_number');
        $hotel->description = $request->input('description');
        $hotel->image = $request->input('cover_image');


        if ($request->hasFile('images')) {
            $file = $request->file('images');
            foreach ($file as $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $request['hotel_id'] = $hotel->id;
                $request['image'] = $imageName;
                $image->move(public_path('images/hotel/'), $imageName);
                ImageHotel::create($request->all());
            }
        }
        $inputs = $request->input('inputs');
        foreach ($inputs as $input) {
            if (isset($input['id'])) {
                $service = Service::find($input['id']);
                $service->name = $input['name_service'];
                $service->save();
            } else {
                $service = new Service();
                $service->name = $input['name_service'];
                $service->hotel_id = $hotel->id;
                $service->save();
            }
        }




        $hotel->save();
        //sau khi luu xong chuyen trang
        return redirect('/hotel')->with('success', 'Cập nhật thành công');
    }

    public function deleteimage($id)
    {
        $images = ImageHotel::find($id);

        if (File::exists("images/hotel/" . $images->image)) {
            File::delete("images/hotel/" . $images->image);
        }
        ImageHotel::find($id)->delete();
        return back();
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->back()->with('success', 'Service deleted successfully');
    }
}
