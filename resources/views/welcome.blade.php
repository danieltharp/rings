@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($announce))
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ $announce->title }}
                    </div>
                    <div class="panel-body">
                        {!! $announce->body !!}
                    </div>
                    <div class="panel-footer">
                        <div class="col-xs-12 col-md-7">{{ $announce->account->username }} posted this on
                            {{ $announce->updated_at }}</div>

                        @can('GlobalGM', $active)
                            <a href="/gm/announce/{{ $announce->id }}/edit" class="btn-info btn
                            col-xs-12 col-md-3">Edit</a>
                            <div class="col-md-1"></div>
                            <a href="/gm/announce/{{ $announce->id }}/delete" class="btn-danger btn
                            col-xs-12 col-md-1">Delete</a>
                        @endcan
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        @forelse ($realms as $realm)
                            {{ $realm->name }} [
                                @if($realm->icon == 0)
                                    <span class="text-success">PVE</span>
                                @elseif($realm->icon == 1)
                                    <span class="text-danger">PVP</span>
                                @elseif($realm->icon == 6)
                                    <span class="text-info">RP</span>
                                @elseif($realm->icon == 8)
                                    <span class="text-warning">RPPVP</span>
                                @endif
                            ] - Up since {{ $realm->diff }}
                            <br>
                        @empty
                            No realms are configured yet for this server.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
