<div class="admin-right">
    @if($current == 2)
        @include('home::b_article.stored')
    @elseif($current == 3)
        @include('home::b_article.rubbish')
    @elseif($current == 4)
        @include('home::b_article.addarticle')
    @elseif($current == 5)
        @include('home::b_article.message')
    @elseif($current == 6)
        @include('home::b_article.adplace')
    @else
        @include('home::b_article.published')
    @endif
</div>