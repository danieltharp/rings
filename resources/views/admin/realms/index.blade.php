@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($realms as $realm)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $realm->name }}
                        <div class="pull-right"><a href="/admin/realms/edit/{{ $realm->id }}">Edit</a></div>
                    </div>

                    <div class="panel-body text-center">
                        @forelse ($realm->databases as $database)
                            @if($database->type == 'c')
                                Character Server:
                            @elseif($database->type == 'w')
                                World Server:
                            @endif
                                {{ $database->address }}:{{ $database->port }} (<a
                                        href="/admin/database/edit/{{ $database->id }}">Edit</a>)<br>
                            @empty
                                No databases configured.
                            <a href="/admin/realms/edit/{{ $realm->id }}">Add Databases</a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop