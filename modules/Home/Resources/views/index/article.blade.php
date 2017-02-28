<div class="article-list">
    <h4 class="latest-title" >
        <a href="" title="">
            <i class="fa fa-book" aria-hidden="true"></i>
            最新文章
            <small>Latest Article</small>
        </a>
    </h4>
    <div class="latest-list">
        <ul>
            @foreach ($article as $item)
                <li class="{{ $item->view_times > 200 ? 'hot' : '' }}" item_id="{{ $item->id }}">
                    <div class="art-img">
                        <img src="../modules/home/images/wx.png" alt="">
                    </div>
                    <div class="art-content">
                        <h4 class="text-blue">
                            <a href="/article/detail/{{$item->id}}" title="{{ $item->title }}">{{ $item->title }}</a>
                        </h4>
                        <p>{{ $item->resume}}</p>
                        <ul>
                            <li>
                                <a title="{{$item->author }}{{ $item->created_at }}发表">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    {{ $item->created_at }}
                                </a>
                            </li>
                            <li>
                                <a title="作者:{{ $item->author }}">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    {{ $item->author }}
                                </a>
                            </li>
                            <li>
                                <a title="已有0条评论">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                    0
                                </a>
                            </li>
                            <li>
                                <a title="已有{{ $item->view_times }}次浏览">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    {{ $item->view_times }}
                                </a>
                            </li>
                            <li>
                                <a title="查看分类">
                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                    {{ isset($item->category) ? $item->category->title : '未分类' }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="article-page">
        <ul>
            <li class="first-page"><a href="?page=1">首页</a></li>
            <li class="pre-page">
                @if($article->currentPage() == 1)
                    上一页
                @else
                    <a href="?page={{ $article->currentPage()-1 }}">上一页</a>
                @endif
            </li>
            @for($i=1;$i < $article->total()/$article->perPage() + 1; $i++)
                @if($i == $article->currentPage())
                    <li class="num current"><a href="?page={{ $i }}">{{ $i }}</a></li>
                @else
                    <li class="num"><a href="?page={{$i}}">{{ $i }}</a></li>
                @endif
            @endfor
            <li class="next-page">
                @if($article->currentPage() == $article->lastPage())
                    下一页
                @else
                    <a href="?page={{ $article->currentPage()+1 }}">下一页</a>
                @endif
            </li>
            <li class="end-page">
                <a href="?page={{ $article->lastPage() }}">尾页</a>
            </li>
            <li class="total">共{{ $article->total() }}条记录</li>
        </ul>
    </div>
</div>