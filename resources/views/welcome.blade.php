@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        @foreach ($realms as $realm)
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
