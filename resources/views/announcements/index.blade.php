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
            @forelse($allAnnouncements as $announcement)
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            @if($announcement->realm_id == -1)
                                Global:
                            @else
                                Realm:
                            @endif
                            {{ $announcement->title }}
                        </div>
                        <div class="panel-body">
                            {!! $announcement->body !!}
                        </div>
                        <div class="panel-footer">
                            {{ $announcement->account->username }} posted this on {{ $announcement->updated_at }}
                            <a href="/gm/announce/{{ $announcement->id }}/delete" class="btn-danger btn
                            pull-right">Delete</a>
                            <a href="/gm/announce/{{ $announcement->id }}/edit" class="btn-info btn pull-right">Edit</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @empty
                No announcements found.
            @endforelse
            <br>
            <a href="/gm/announce/add" class="btn btn-success">Add Announcement</a>
    </div>
@stop