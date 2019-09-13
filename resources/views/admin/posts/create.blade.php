@extends("layouts.admin")
@section('content')
    <h3 class="text-center text-success">Create Posts</h3>

    {!! Form::open(['method'=>'POST','action'=>'AdminPostController@store','files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title','Title:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        @if($errors->has('title'))
            <span class="help-block">
                <strong class="text-danger">{{$errors->first('title')}}</strong>
            </span>
        @endif


        {!! Form::label('category','Categroy:') !!}
        {!! Form::select('category_id',array(''=>'Choose')+$categories,null,['class'=>'form-control']) !!}


        @if($errors->has('category_id'))
            <span class="help-block">
                <strong class="text-danger">
                    {{$errors->first('category_id')}}
                </strong>
            </span>
        @endif

        {!! Form::label('photo_id','Photo:') !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}

        @if($errors->has('photo_id'))
            <span class="help-block">
                <strong class="text-danger">
                    {{$errors->first('photo_id')}}
                </strong>
            </span>
        @endif


        {!! Form::label('body','Description:') !!}
        {!! Form::textarea('body',null,['class'=>'form-control']) !!}


        @if($errors->has('body'))
            <span class="help-block">
                <strong class="text-danger">
                    {{$errors->first('body')}}
                </strong>
            </span>
        @endif

        <br>
        {!! Form::submit('Create post',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection
