@extends('master.teacher.master')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Approved Subject</h4>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject Title</th>
                                <th>Code</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$subject->title}}</td>
                                    <td>{{$subject->code}}</td>
                                    <td>{{number_format($subject->fee)}}</td>
                                    <td>{{$subject->status == 1 ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <a href="{{route('enrolled-student', ['id' => $subject->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-list"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
