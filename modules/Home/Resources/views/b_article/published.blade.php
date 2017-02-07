<div class="art-published">
    <ul>
        @foreach($data as $item)
        <li>
            <div class="art-img">
                <img src="{{ $item->link_img }}" alt="">
            </div>
            <div class="art-content">
                <h4 class="text-blue">
                    <a href="" title="{{ $item->title }}">{{ $item->title }}</a>
                </h4>
                <p>{{ $item->resume }}</p>
                <ul>
                    <li>
                        <a title="zpc{{ $item->created_at }}发表">
                            <i>发布时间:</i>
                            {{ $item->created_at }}
                        </a>
                    </li>
                    <li>
                        <a title="作者:zpc">
                            <i>作者：</i>
                            zpc
                        </a>
                    </li>
                    <li>
                        <a title="已有0条评论">
                            <i>评论数：</i>
                            0
                        </a>
                    </li>
                    <li>
                        <a title="已有{{ $item->view_times }}次浏览">
                            <i>浏览次数：</i>
                            {{ $item->view_times }}
                        </a>
                    </li>
                    <li>
                        <a title="查看分类">
                            <i>分类：</i>
                            {{ $item->category }}
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endforeach
    </ul>
</div>