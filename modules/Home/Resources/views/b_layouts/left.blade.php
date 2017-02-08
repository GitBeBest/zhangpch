<div class="admin-left">
    <div class="user_info">
        <h4 class="user-name">{{ $user->name }}</h4>
        <h4><a href="/logout">退出登陆</a></h4>
    </div>
    <div>
        <ul>
            @if($current == 1)
                <li class="current">
            @else
                <li>
            @endif
                <a href="/admin/1">已发布文章</a>
            </li>
            @if($current == 2)
                <li class="current">
            @else
                <li>
            @endif
                <a href="/admin/2">草稿</a>
            </li>
            @if($current == 3)
                <li class="current">
            @else
                <li>
            @endif
                 <a href="/admin/3">垃圾箱</a>
            </li>
            @if($current == 4)
                <li class="current">
            @else
                <li>
            @endif
                 <a href="/admin/4">发表文章</a>
            </li>
            @if($current == 5)
                <li class="current">
            @else
                <li>
            @endif
                <a href="/admin/5">评论管理</a>
            </li>
            @if($current == 6)
                <li class="current">
            @else
                <li>
            @endif
                <a href="/admin/6">广告位</a>
            </li>
        </ul>
    </div>
</div>