@extends('layouts.admin')
@section('content')
    <h3 class="text-info">&nbsp;&nbsp;&nbsp;Edit User!</h3>
    <hr>
    <div class="col-sm-2">
        <img src="{{$user->photo ? $user->photo->file : '/images/placehoder.jpg'}}" alt="" class="img-responsive img-thumbnail">
    </div>
    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUserController@update',$user->id],'files'=>true]) !!}
    <div class="form-group col-sm-8">
        {!! Form::label('name','Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
        {!! Form::label('emil','E-Mail:') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
        {!! Form::label('role_id','Role:') !!}
        {!! Form::select('role_id',array(''=>'Choose Option')+$roles ,null,['class'=>'form-control']) !!}
        {!! Form::label('status','Status:') !!}
        {!! Form::select('is_active',array(1=>'Active',0=>'Not Active'),null,['class'=>'form-control']) !!}
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