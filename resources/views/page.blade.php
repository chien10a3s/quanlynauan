@extends('layouts.1column')

@section('htmlheader_title')
	{{ Voyager::setting('title') }} - {{ $page->title }}
@endsection

@section('main-content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    
    <div class="rte">
        <div class="page-image">
            <img class="img-responsive" src="{{ Voyager::image( $page->image ) }}"/>
        </div>
        {!! $page->body !!}
    </div>
    
</div>
@endsection
