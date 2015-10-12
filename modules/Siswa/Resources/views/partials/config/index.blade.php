@extends('siswa::layouts.master')

@section('content')

    <div class="page animsition">

        {{-- Modal --}}
        <div class="modal fade" id="modalAddRole" aria-hidden="true" aria-labelledby="AddRole" role="dialog" tabindex="-1">
        	<div class="modal-dialog modal-sidebar modal-sm">
        		<div class="modal-content">
                    <form action="{{ url('/user') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="role" value=true>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">New Role</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama Role">
                            </div>
                            <div class="form-group">
                                <textarea name="desc" class="form-control" id="" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </form>
        		</div><!-- /.modal-content -->
        	</div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modalAddUser" aria-hidden="true" aria-labelledby="AddUser" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="{{ url('/user') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="user" value=true>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">New User</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama User">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="text" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                @if($roles)
                                    <select name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{-- / Modal --}}

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddRole" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormKelas">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Role
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddUser" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormContract">
                    <i class="icon wb-pencil" aria-hidden="true"></i> User
                </button>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                        <li class="active" role="presentation">
                            <a data-toggle="tab" href="#tabTahunAjar" aria-controls="tabTahunAjar" role="tab">Tahun Ajar</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#tabUsers" aria-controls="tabUsers" role="tab">User</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tabTahunAjar" role="tabpanel">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="col-md-6">
                                                <br>
                                                <form action="{{ url('/siswa/config') }}" method="post" class=form-horizontal>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                    <div class="form-group">
                                                        <label for="" class="control-label col-md-4">Tahun Ajar</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="tahun_ajar" value="{{ $configs[0]->value }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-primary">Set</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tabUsers" role="tabpanel">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <h4>Roles</h4>
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($roles)
                                                        @foreach($roles as $role)
                                                            <tr>
                                                                <td>{{ $role->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <h4>Users</h4>
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Role</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($users)
                                                        @foreach($users as $usr)
                                                            <tr>
                                                                <td>{{ $usr->name }}</td>
                                                                <td>
                                                                    <ul>
                                                                        @foreach($usr->roles as $role)
                                                                            <li>{{ $role->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop