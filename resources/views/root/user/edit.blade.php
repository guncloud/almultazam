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
                <div class="col-md-4">
                    <form action="{{ url('/user/'.$user->id) }}" method="post" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ ($user->roles[0]->id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
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
@stop

@stop