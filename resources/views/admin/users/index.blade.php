@extends('layouts.admin')
@section('content')
    <h3>User Page!</h3>
    <div class="table-responsive"><table class="table table-hover table-striped">
            <thead class="text-success">
            <tr class="text-center">
                <th>ID</th>
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
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>

                <td>{{$user->is_active == 1 ? "Active" : "Not Active"}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td><span class="glyphicon glyphicon-edit text-primary updateteacher" id=""></span><small>&nbsp;&nbsp;|&nbsp;&nbsp;</small><span class="glyphicon glyphicon-trash text-danger deleteteacher" id=""></span></td>
            </tr>
                @endforeach()
            @endif()
            </tbody>
        </table>
    </div>
@endsection