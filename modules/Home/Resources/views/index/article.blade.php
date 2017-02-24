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
                                    {{ $item->category }}
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
            <li class="first-page">首页</li>
            <li class="pre-page">上一页</li>
            <li class="num current">1</li>
            <li class="num">2</li>
            <li class="num">3</li>
            <li class="num">4</li>
            <li class="next-page">下一页</li>
            <li class="end-page">尾页</li>
            <li class="total">共26条记录</li>
        </ul>
    </div>
</div>