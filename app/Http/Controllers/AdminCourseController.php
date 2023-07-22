<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    private $subject;
    private $subjects;
    private $message;

    public function manage()
    {
        $this->subjects = Subject::orderBy('id', 'desc')->get();
        return view('admin.course.manage', ['subjects' => $this->subjects]);
    }

    public function detail($id)
    {
        $this->subject = Subject::find($id);
        return view('admin.course.detail', ['subject' => $this->subject ]);
    }

    public function updateStatus($id)
    {
        $this->message = Subject::updateSubjectStatus($id);
        return redirect()->back()->with('message', $this->message);
    }
}
