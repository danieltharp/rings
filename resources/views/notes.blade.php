@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item">
                Getting the password for a user looks like:<br>
                sha1(USERNAME:PASSWORD)<br>
                That corresponds to the value of sha_pass_hash.<br>
                More specifically, it's:<br>
                <code>sha1(strtoupper($username).':'.strtoupper($password));</code>
            </li>
        </ul>
    </div>
@stop