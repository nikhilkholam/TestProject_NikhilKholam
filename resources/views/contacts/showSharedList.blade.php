@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Contacts</h5></div>
                <div class="card-body">
                    <a href="/contacts/shareList" class="btn btn-primary">Back to List</a>
                    <div class="table-entry table-responsive tableFixHead topSpace">
                        <table class="table table-striped">
                            <tbody>
                                <tr><th>First Name:</th><td>{{$contact->firstName}}</td></tr>
                                <tr><th>Middle Name:</th><td>{{$contact->middleName}}</td></tr>
                                <tr><th>Last Name:</th><td>{{$contact->lastName}}</td></tr>
                                <tr><th>Primary Phone:</th><td>{{$contact->primaryPhone}}</td></tr>
                                <tr><th>Secondary Phone:</th><td>{{$contact->secondaryPhone}}</td></tr>                               
                                <tr><th>Email:</th><td>{{$contact->emailId}}</td></tr>
                                <tr><th>Contact Image:</th><td>{{$contact->image}}</td></tr>
                                <tr><th>Shared By:</th><td>{{$contact->sharedBy}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
