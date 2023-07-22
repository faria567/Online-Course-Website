<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    private static $student;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'student-images/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }
    public static function updateStudentProfile($request, $id)
    {
        self::$student = Student::find($id);
        self::$student->name    = $request->name;
        self::$student->email   = $request->email;
        self::$student->mobile  = $request->mobile;
        if ($request->file('image'))
        {
            if (file_exists(self::$student->image))
            {
                unlink(self::$student->image);
            }
            self::$student->image   =   self::getImageUrl($request);
        }
        self::$student->save();
    }

    public static function updateStudentPassword($request, $id)
    {
        self::$student = Student::find($id);
        self::$student->password = bcrypt($request->password);
        self::$student->save();
    }

    public static function newStudent($request)
    {
        self::$student          = new Student();
        self::$student->name    = $request->name;
        self::$student->email   = $request->email;
        self::$student->mobile  = $request->mobile;
        self::$student->password= bcrypt($request->password);
        self::$student->save();
        return self::$student;
    }
}
