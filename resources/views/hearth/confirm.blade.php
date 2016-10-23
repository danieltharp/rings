@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $active->name }} - Hearthstone
                    </div>

                    <div class="panel-body text-center">
                        {{ $chartohearth->name }} - Hearthstone this character?<br><br>

                        Note: You must be logged out before clicking Hearthstone or it won't do anything at all.<br><br>

                        <form method="post" action="/hearth/{{ $chartohearth->guid }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Hearthstone</button>
                        </form>
                        <br><a href="/home"><button class="btn btn-danger">Cancel</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop