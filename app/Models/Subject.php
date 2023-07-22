<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Subject extends Model
{
    use HasFactory;
    private static $subject;
    private static $directory;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $message;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'subject-images/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newSubject($request)
    {
        self::$subject = new Subject();
        self::$subject->teacher_id          = Session::get('user_id');
        self::$subject->title               = $request->title;
        self::$subject->code                = $request->code;
        self::$subject->fee                 = $request->fee;
        self::$subject->short_description   = $request->short_description;
        self::$subject->long_description    = $request->long_description;
        self::$subject->image               = self::getImageUrl($request);
        self::$subject->save();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public static function updateSubjectStatus($id)
    {
        self::$subject = Subject::find($id);
        if (self::$subject->status == 0)
        {
            self::$subject->status = 1;
            self::$message = 'Course info active successfully.';
        }
        else
        {
            self::$subject->status = 0;
            self::$message = 'Course info inactive successfully.';
        }
        self::$subject->save();
        return self::$message;
    }
}
