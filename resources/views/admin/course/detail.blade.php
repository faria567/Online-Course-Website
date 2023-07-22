@extends('master.admin.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Subject Title</th>
                        <td>{{$subject->title}}</td>
                    </tr>
                    <tr>
                        <th>Subject Code</th>
                        <td>{{$subject->code}}</td>
                    </tr>
                    <tr>
                        <th>Subject Fee</th>
                        <td>{{$subject->fee}}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{!! $subject->short_description !!}</td>
                    </tr>
                    <tr>
                        <th>Long Description</th>
                        <td>{!! $subject->long_description !!}</td>
                    </tr>
                    <tr>
                        <th>Trainer Name</th>
                        <td>{{$subject->teacher->name}}</td>
                    </tr>
                    <tr>
                        <th>Feature Image</th>
                        <td>
                            <img src="{{asset($subject->image)}}" alt=""/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
