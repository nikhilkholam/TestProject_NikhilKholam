@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Contacts</h5></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="btn-toolbar">
                                <a href="#" class="btn btn-success btnSpace">Active List</a>
                                <a href="/contacts/dlist" class="btn btn-primary btnSpace">Deactive List</a>
                                <a href="/contacts/shareList" class="btn btn-primary btnSpace">Share List</a>
                                <a href="/contacts/create" class="btn btn-primary btnSpace">Add Contact</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="text" value="" id="myInput" class="form-control myInput" placeholder="Search Contact">
                        </div>
                    </div>
                    @if(count($contacts)>0)
                        <div class="topSpace" id="div_print" style="height: auto;">
                            <div class="table-entry table-responsive tableFixHead">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact No</th>
                                            <th>Email Id</th>
                                            <th colspan="3" class="text-center" width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    {!! Form::open(['action' => 'ContactUsController@userShare', 'method' => 'GET']) !!}
                                        <tbody id="myTable">
                                            @foreach($contacts as $cont)
                                                <tr>
                                                    <td><input type="checkbox" name="select[]" value="{{$cont->id}}"></td>
                                                    <td id="name{{$cont->id}}">{{$cont->firstName}} {{$cont->middleName}} {{$cont->lastName}}</td>
                                                    <td>{{$cont->primaryPhone}}</td>
                                                    <td>{{$cont->emailId}}</td>
                                                    <td><a href="/contacts/{{$cont->id}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Show</a></td>
                                                    <td><a href="/contacts/{{$cont->id}}/edit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">Edit</a></td>
                                                    <td><a href="/contacts/{{$cont->id}}/downloadVCF" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">Download</a></td>
                                                </tr>
                                            @endforeach                                          
                                        </tbody>
                                        <tr>
                                            <td>{{Form::select('userId', $users, null, ['class'=>'form-control', 'placeholder'=>'Pick a User', 'required'])}}</td>
                                            <td>{{Form::submit('Share', ['class'=>'btn btn-warning btnSpace'])}}</td>
                                            <td colspan="5"></td>                                                
                                        </tr>
                                    {!! Form::close() !!}
                                </table>
                            </div>
                        </div>
                    @else
                        <h5 class="topSpace">No Active Records Found.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


