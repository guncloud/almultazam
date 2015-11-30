@extends('root.layout.root_master')

@section('content')

    <style>
        body{
            font-size: 13px;
        }
    </style>

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">

            </div>
        </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                	<div class="panel-heading">
                        <h4 class="panel-title">Users</h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users)
                                @foreach($users as $i => $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <form action="{{ url('/user/'.$user->id) }}" method="post" id="formDelete">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <a class="btn btn-link" href="{{ url('/user/'.$user->id.'/edit') }}">Edit</a>
                                                <button type="submit" class="btnDelete btn btn-link">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">New User</h4>
                    </div>
                    <div class="panel-body">
                        <br>
                        <form action="{{ url('/user/') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){

            $('.btnDelete').click(function(e){
                e.preventDefault();

                var r = confirm("Anda akan menghapus data, yakin ?!");
                if (r == true) {
                    $(this).closest('form').submit();
                } else {
                    return false;
                }

            })

        })
    </script>
@stop