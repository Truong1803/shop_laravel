<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'sort_by',
        'active',
        'thumb',
    ];

    public function saveData($request) {
        try {
            //code...
            $request->except('_token');
            $this->create($request->all());
            Session::flash('success', 'Them Slider moi thanh cong');
        } catch (\Exception $e) {
            //throw $th;
            Session::flash('error', 'Them Slider moi ko thanh cong');
            return false;
        }

        return true;
    }

    public function get() {
        return $this->orderByDesc('id')->paginate(15);
    }


    public function edit($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật Slider thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật slider Lỗi');

            return false;
        }

        return true;
    }

    public function deleteData($request)
    {
        $slider = $this->where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return $this->where('active', 1)->orderByDesc('sort_by')->get();
    }
}
