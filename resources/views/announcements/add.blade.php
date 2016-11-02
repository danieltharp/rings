@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="/gm/announce" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title" class="control-label">Title:</label>
                    <input id="title" type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                    <script>tinymce.init({
                            selector: 'textarea',
                            height: 500,
                            theme: 'modern',
                            plugins: [
                                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                'searchreplace wordcount visualblocks visualchars code fullscreen',
                                'insertdatetime media nonbreaking save table contextmenu directionality',
                                'emoticons template paste textcolor colorpicker textpattern imagetools codesample'
                            ],
                            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                            image_advtab: true,
                            content_css: [
                                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                                '//www.tinymce.com/css/codepen.min.css'
                            ]
                        });</script>
                    <textarea class="form-control" name="body"></textarea>
                </div>
                <div class="form-group">
                    <label for="realm_id">Realm to announce for:</label>
                    <select id="realm_id" name="realm_id" class="form-control">
                        @foreach($realms as $realm)
                            @can('GM', $realm)
                                <option value="{{ $realm->id }}">{{ $realm->name }}</option>
                            @endcan
                        @endforeach
                        @can('GlobalGM', $active)
                            <option value="-1">Global</option>
                        @endcan
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right col-xs-12 col-md-4">Publish</button>
                </div>
            </form>
        </div>
    </div>
@stop