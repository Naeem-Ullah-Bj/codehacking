
@extends('layouts.admin')

@section('content')
    <h3>User Page!</h3>
    <div class="table-responsive"><table class="table table-hover table-striped">
            <thead class="text-success">
            <tr class="text-center">
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created-at</th>
                <th>Updated-at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($users)
                @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img height="50px" src="{{$user->photo ? $user->photo->file : '/images/placehoder.jpg'}}" alt="" class="img-circle"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->is_active}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>


                <td><a href="{{route('users.edit',$user->id)}}"><span class="glyphicon glyphicon-edit text-primary updateteacher" id=""></span></a><small>&nbsp;&nbsp;|&nbsp;&nbsp;</small>
                    <a href="{{$url = action('AdminUserController@destroy',$user->id)}}"  ><span class="glyphicon glyphicon-trash text-danger deleteteacher" id=""></span></a></td>
            </tr>
                @endforeach()
            @endif()
            </tbody>
        </table>
    </div>

@endsection

@section('footer')
    @if(Session::has('destroy'))
    <script type="text/javascript">
        $(document).ready(function(){
            $.toast({
                heading:"Success !",
                text:"User Deleted Successfully !",
                icon:"success",
                showHideTransition:"plain",
                position:"top-right"
            });
        })
    </script>
    @endif
    @endsection


