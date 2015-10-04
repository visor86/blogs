@extends('layouts.default')
@section('title', $post->title)
@section('meta_description', $post->meta_description)
@section('meta_keywords', $post->meta_keywords)
@section('content')
    <div class="row">
        <div class="c10 o1">
            <h1> {{ $post->title }}</h1>
            <div class="detail">
                <div class="meta">
                    <div class="mask">
                        <img src="/images/avatar.jpg" width="33" height="33" alt="Tara Clapper">
                    </div>
                    <div class="fname">Tara Clapper</div>
                    <time>{{ $post->date_from->format('F d, Y')  }}</time>
                </div>
                @if ($post->images)
                <div class="image-detail">
                    <div clas="images">
                        <img src="{{ page_image($post->images) }}" alt="">
                    </div>
                </div>
                @endif
                <div class="text">
                    {!! $post->text !!}
                </div>
                <div class="back">
                    <a href="{{ route('posts') }}">&leftarrow; Back to the article list</a>
                </div>
            </div>
        </div>
    </div>
@stop