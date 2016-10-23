@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                   {{ $active->name }}
                </div>

                <div class="panel-body">
                    @forelse ($chars as $char)
                        {{ $char->name }} [<a href="/hearth/{{ $char->guid }}">Hearth</a>]
                        <br>
                    @empty
                        You have no characters on this realm.
                    @endforelse
                </div>
            </div>
            @can('authorize', \App\Admin::class)
                You are an Admin.
            @endcan
        </div>
    </div>
</div>
@endsection
