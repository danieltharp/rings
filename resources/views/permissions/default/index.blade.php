@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('status'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Alert
                        </div>

                        <div class="panel-body">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <form action="/admin/permissions" method="post">
            {{ csrf_field() }}
        @foreach($perms as $perm)
                <select name="{{ $perm->olid }}">
                    <option value="192"  <?php if ($perm->oid == 192) { echo "selected"; } ?>>Role: Sec Level
                        Administrator</option>
                    <option value="193"  <?php if ($perm->oid == 193) { echo "selected"; } ?>>Role: Sec Level
                        Gamemaster</option>
                    <option value="194"  <?php if ($perm->oid == 194) { echo "selected"; } ?>>Role: Sec Level
                        Moderator</option>
                    <option value="195"  <?php if ($perm->oid == 195) { echo "selected"; } ?>>Role: Sec Level
                        Player</option>
                    <option value="196"  <?php if ($perm->oid == 196) { echo "selected"; } ?>>Role: Administrator
                        Commands</option>
                    <option value="197"  <?php if ($perm->oid == 197) { echo "selected"; } ?>>Role: Gamemaster
                        Commands</option>
                    <option value="198"  <?php if ($perm->oid == 198) { echo "selected"; } ?>>Role: Moderator
                        Commands</option>
                    <option value="199"  <?php if ($perm->oid == 199) { echo "selected"; } ?>>Role: Player
                        Commands</option>
                    {{ $perm->id }}
                </select>
                <label for="{{ $perm->olid }}">{{ $perm->linkedId }}</label>
            <br>
        @endforeach
            <br>
            <button type="submit" class="btn btn-success col-xs-12">Update</button>
        </form>
    </div>
@stop