@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-danger">
                <div class="panel-heading">Confirm Deletion</div>
                <div class="panel-body text-center">
                    Confirm you wish to delete this announcement?<br>
                    Title: {{ $ann->title }}<br>
                    Posted by: {{ $ann->account->username }}<br><br>
                    <form action="/gm/announce/{{ $ann->id }}/delete" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop