<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index() {
        return view('admin.slider.list', [
            'title' => 'Danh sach slider moi nhat',
            'sliders' => $this->slider->get(),
        ]);
    }
    //
    public function create() {
        return view('admin.slider.add', [
            'title' => 'Them Slider moi',
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);
        $this->slider->saveData($request);
        return redirect()->back();
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Chỉnh Sửa Slider',
            'slider' => $slider
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url'   => 'required'
        ]);

        $result = $this->slider->edit($request, $slider);
        if ($result) {
            return redirect('/admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->deleteData($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công Slider'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
    
}
