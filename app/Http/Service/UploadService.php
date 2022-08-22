<?php

namespace App\Http\Service;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                //code...
                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'public/uploads/' . date("Y/m/d");
                $path = $request->file('file')->storeAs('public/' . $pathFull, $name);

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $th) {
                //throw $th;
                return false;
            }
        }
    }
}
