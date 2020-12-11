@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Contacts</h5></div>
                <div class="card-body">
                   @if($contact->active==1)
                        <a href="/contacts" class="btn btn-primary">Back to List</a>
                    @else
                        <a href="/contacts/dlist" class="btn btn-primary">Back to List</a>
                    @endif
                    <div class="table-entry table-responsive tableFixHead topSpace">
                        <table class="table table-striped">
                            <tbody>
                                <tr><th>First Name:</th><td>{{$contact->firstName}}</td></tr>
                                <tr><th>Middle Name:</th><td>{{$contact->middleName}}</td></tr>
                                <tr><th>Last Name:</th><td>{{$contact->lastName}}</td></tr>
                                <tr><th>Primary Phone:</th><td>{{$contact->primaryPhone}}</td></tr>
                                <tr><th>Secondary Phone:</th><td>{{$contact->secondaryPhone}}</td></tr>                               
                                <tr><th>Email:</th><td>{{$contact->emailId}}</td></tr>
                                <tr><th>Contact image:</th><td>
                                    @if($contact->image != NULL)
                                        <img alt="" src="/images/{{$contact->image}}" height="75px" width="75px;">
                                    @else
                                        -
                                    @endif
                                  </td></tr>                               
                                <tr>
                                    @if($contact->active==0)
                                        <td colspan="2">
                                            <a href="/contacts/{{$contact->id}}/activate">
                                                {!! Form::open(['action' => ['ContactUsController@activate', $contact->id], 'method'=>'GET']) !!}
                                                    {{Form::hidden('_method', 'ACTIVATE')}}
                                                    {{Form::button('<span class="fa fa-check"></span><span class="separator"></span>&nbsp;&nbsp;&nbsp;Activate&nbsp;&nbsp;&nbsp;', array('class'=>'btn btn-success confirmActivate', 'type'=>'submit')) }}
                                                {!! Form::close() !!}
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="/contacts/{{$contact->id}}/deactivate">
                                                {!! Form::open(['action' => ['ContactUsController@deactivate', $contact->id], 'method'=>'GET']) !!}
                                                    {{Form::hidden('_method', 'DEACTIVATE')}}
                                                    {{Form::button('<span class="fa fa-trash"></span><span class="separator"></span>&nbsp;&nbsp;&nbsp;Deactivate&nbsp;&nbsp;&nbsp;', array('class'=>'btn btn-danger confirmDeactivate', 'type'=>'submit')) }}
                                                {!! Form::close() !!}
                                            </a>
                                        </td>
                                    @endif
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
