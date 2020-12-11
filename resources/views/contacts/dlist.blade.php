@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Contacts</h5></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-toolbar">
                                <a href="/contacts" class="btn btn-primary btnSpace">Active List</a>
                                <a href="#" class="btn btn-success btnSpace">Deactive List</a>
                                <a href="/contacts/shareList" class="btn btn-primary btnSpace">Share List</a>
                                <a href="/contacts/create" class="btn btn-primary btnSpace">Add Contact</a>
                            </div>
                        </div>
                    </div>
                    @if(count($contacts)>0)
                        <div class="topSpace" id="div_print" style="height: auto;">
                            <div class="table-entry table-responsive tableFixHead">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact No</th>
                                            <th>Email Id</th>
                                            <th colspan="2" class="text-center" width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $cont)
                                            <tr>
                                                <td>{{$cont->firstName}} {{$cont->middleName}} {{$cont->lastName}}</td>
                                                <td>{{$cont->primaryPhone}}</td>
                                                <td>{{$cont->emailId}}</td>
                                                <td><a href="/contacts/{{$cont->id}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Show</a></td>
                                                <td><a href="/contacts/{{$cont->id}}/edit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">Edit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <h5 class="topSpace">No Deactive Records Found.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
