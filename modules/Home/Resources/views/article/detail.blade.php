<div class="article-list art-detail">
    <article id="publish-art" article_id="{{ $article->id }}" class="article-body">
        <div class="blog-post-meta">
            <h1>{{ $article->title }}</h1>
        </div>
        <div class="blog-main">
            {{ $article->content }}
        </div>
    </article>
    <div class="up-down">
        <div class="up has-border" id="up-enable">
            <div  class="up-down-num" >
                <span id="span-up-num">{{ $article->praise_times }}</span>
            </div>
            <i class="fa fa-thumbs-o-up fa-3x" aria-hidden="true"></i>
        </div>
        <div class="down has-border" id="down-enable">
            <div class="up-down-num">
                <span id="span-down-num">{{ $article->hate_times }}</span>
            </div>
            <i class="fa fa-thumbs-o-down fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
{!! csrf_field() !!}