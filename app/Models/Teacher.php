<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    private static $teacher;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'teacher-images/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newTeacher($request, $code)
    {
        self::$teacher = new Teacher();
        self::$teacher->name    = $request->name;
        self::$teacher->code    = $code;
        self::$teacher->email   = $request->email;
        self::$teacher->password= bcrypt($request->mobile);
        self::$teacher->mobile  = $request->mobile;
        self::$teacher->address = $request->address;
        self::$teacher->image   = self::getImageUrl($request);
        self::$teacher->save();
    }

    public static function updateTeacher($request, $id, $code)
    {
        self::$teacher = Teacher::find($id);
        if($request->file('image'))
        {
            if (file_exists(self::$teacher->image))
            {
                unlink(self::$teacher->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$teacher->image;
        }
        self::$teacher->name    = $request->name;
        self::$teacher->code    = $code;
        self::$teacher->email   = $request->email;
        self::$teacher->password= bcrypt($request->mobile);
        self::$teacher->mobile  = $request->mobile;
        self::$teacher->address = $request->address;
        self::$teacher->image   = self::$imageUrl;
        self::$teacher->status  = $request->status;
        self::$teacher->save();

    }

}
