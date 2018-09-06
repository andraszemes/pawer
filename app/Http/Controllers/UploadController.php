<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getName($image)
    {
        return time().'.'.$image->getClientOriginalExtension();
    }

    protected function getPath($directory)
    {
        return public_path($directory);
    }

    public function store(UploadRequest $request)
    {
        $image = $request->file('image');

        $image->move($this->getPath('/images'), $this->getName($image));

        return back()->with('status', 'Image upload successful');
    }
}
