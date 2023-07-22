<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Subject;
use Illuminate\Http\Request;
use Session;

class SubjectController extends Controller
{
    private $subject;
    private $subjects;
    private $enrolls;

    public function index()
    {
        return view('teacher.subject.add');
    }

    public function create(Request $request)
    {
        Subject::newSubject($request);
        return redirect()->back()->with('message', 'Subject info create successfully.');
    }

    public function manage()
    {
        $this->subjects = Subject::where('teacher_id', Session::get('user_id'))->get();
        return view('teacher.subject.manage', ['subjects' => $this->subjects]);
    }

    public function approved()
    {
        $this->subjects = Subject::where('teacher_id', Session::get('user_id'))->where('status', 1)->get();
        return view('teacher.subject.approved', ['subjects' => $this->subjects]);
    }

    public function enrolledStudent($id)
    {
        $this->enrolls = Enroll::where('subject_id', $id)->get();
        return view('teacher.subject.enrolled-student', ['enrolls' => $this->enrolls]);
    }
}
