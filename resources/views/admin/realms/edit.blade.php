@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('status'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">Alert</div>
                        <div class="panel-body">{{ session('status') }}</div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Character Server</div>
                    <div class="panel-body">
                        <form method="post" action="/admin/realms">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" name="address" value="{{ $cs->address or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="port" class="control-label">Port</label>
                                <input type="number" name="port" value="{{ $cs->port or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Database Name</label>
                                <input type="text" name="name" value="{{ $cs->name or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="control-label">Database User</label>
                                <input type="text" name="username" value="{{ $cs->username or '' }}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Database Password</label>
                                <input type="password" name="password" value="{{ $cs->password or '' }}"
                                       class="form-control">
                            </div>
                            <input type="hidden" name="id" value="{{ $cs->id or 0 }}">
                            @if(!isset($cs->id))
                                <input type="hidden" name="newdb" value="{{ $realm->id }}">
                                <input type="hidden" name="type" value="c">
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">World Server</div>
                    <div class="panel-body">
                        <form method="post" action="/admin/realms">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" name="address" value="{{ $ws->address or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="port" class="control-label">Port</label>
                                <input type="number" name="port" value="{{ $ws->port or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Database Name</label>
                                <input type="text" name="name" value="{{ $ws->name or '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="control-label">Database User</label>
                                <input type="text" name="username" value="{{ $ws->username or '' }}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Database Password</label>
                                <input type="password" name="password" value="{{ $ws->password or '' }}"
                                       class="form-control">
                            </div>
                            <input type="hidden" name="id" value="{{ $ws->id or 0 }}">
                            @if(!isset($ws->id))
                                <input type="hidden" name="newdb" value="{{ $realm->id }}">
                                <input type="hidden" name="type" value="w">
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop