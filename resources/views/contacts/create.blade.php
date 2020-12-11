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
                            <a href="/contacts" class="btn btn-primary btnSpace">Active List</a>
                            <a href="/contacts/dlist" class="btn btn-primary btnSpace">Deactive List</a>
                            <a href="/contacts/shareList" class="btn btn-primary btnSpace">Share List</a>
                            <a href="#" class="btn btn-success btnSpace">Add Contact</a>
                       </div>
                    </div>
                    <hr>
                    {!! Form::open(['action' => 'ContactUsController@store', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row form-group topSpace">
                            {{Form::label('firstName', 'First Name', ['class'=>'required col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::text('firstName', '', ['class'=>'form-control', 'placeholder'=>'First Name', 'required'])}}
                            </div>
                            {{Form::label('middleName', 'Middle Name', ['class'=>'col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::text('middleName', '', ['class'=>'form-control', 'placeholder'=>'Middle Name'])}}
                            </div>
                        </div>
                        <div class="row form-group topSpace">
                            {{Form::label('lastName', 'Last Name', ['class'=>'required col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::text('lastName', '', ['class'=>'form-control', 'placeholder'=>'Last Name', 'required'])}}
                            </div>
                        </div>
                        <div class="row form-group topSpace">
                            {{Form::label('primaryPhone', 'Primary Phone', ['class'=>'required col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::text('primaryPhone', '', ['class'=>'form-control', 'placeholder'=>'Primary Phone', 'required'])}}
                            </div>
                            {{Form::label('secondaryPhone', 'Secondary Phone', ['class'=>'col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::text('secondaryPhone', '', ['class'=>'form-control', 'placeholder'=>'Secondary Phone'])}}
                            </div>
                        </div>
                        <div class="row form-group topSpace">
                            {{Form::label('emailId', 'Email Id', ['class'=>'required col-md-2'])}}
                            <div class="col-md-4">
                                {{Form::email('emailId', '', ['class'=>'form-control', 'placeholder'=>'Email Id', 'required'])}}
                            </div>
                            {{Form::label('image', 'Contact Image/photo', ['class'=>'col-md-2'])}}
                            <div class="col-md-4">
                                <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg" >
                            </div>                           
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="btn-toolbar">
                                    {{Form::submit('Submit', ['class'=>'btn btn-primary btnSpace'])}}
                                    {{Form::reset('Reset', ['class'=>'btn btn-primary btnSpace'])}}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
