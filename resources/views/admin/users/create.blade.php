@extends('layouts.admin')
@section('content')
    <h3 class="text-danger">Create User!</h3>
    {!! Form::open(['method'=>'POST','action'=>'AdminUserController@store','files'=>true]) !!}
    <div class="form-group col-sm-offset-2 col-sm-8">
        {!! Form::label('name','Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
        {!! Form::label('emil','E-Mail:') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
        {!! Form::label('role_id','Role:') !!}
        {!! Form::select('role_id',array(''=>'Choose Option')+$roles ,null,['class'=>'form-control']) !!}
        {!! Form::label('status','Status:') !!}
        {!! Form::select('is_active',array(1=>'Active',0=>'Not Active'),0,['class'=>'form-control']) !!}
        {!! Form::label('file','File:') !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}

        <br>
        {!! Form::submit('Create User',['class'=>'btn btn-info']) !!}
    </div>
    {!! Form::close() !!}
@include('include.form_error')
@endsection()
@section('footer')

@endsection()