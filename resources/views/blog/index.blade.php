@extends('layouts.default')
@section('title', config('blog.title'))
@section('content')
    <div class="row">
        <div class="c12">
            <h1>{{ config('blog.title') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="c9">
            <section class="content">
                @each('blog.item', $posts, 'post')
            </section>
            <nav>
                <div class="pages">
                    <div class="row">
                        <div class="c12">
                           {!! $posts->render() !!}
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="c3">
            <aside class="sidebar">
                <img src="/images/banner.png" height="419" width="213" alt="">
            </aside>
            </section>
        </div>
    </div>
@stop