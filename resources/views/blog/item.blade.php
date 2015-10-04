<article class="post">
    <div class="row">
        <div class="c9">
            <time>{{ $post->date_from->format('F d, Y')  }}</time>
            <h2><a href="{{ route('post', ['id' => $post->slug])  }}">{{ $post->title  }}</a>
                <span></span>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="c3">
            @if ($post->images)
            <div clas="images">
                <a href="{{ route('post', ['id' => $post->slug])  }}">
                    <img src="{{ page_image($post->images, true) }}" alt="">
                </a>
            </div>
            @endif
        </div>
        <div class="c6">
            <div class="post-text">
                {!! $post->preview  !!}
            </div>
        </div>
    </div>
</article>