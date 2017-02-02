@section('header')
    <header class="bl-header">
        <div class="bl-header-top">
            <div class="bl-header-top-left">
                <div class="bl-header-logo">
                    <a href="/">
                        <img src="../modules/home/images/logo.gif">
                    </a>
                </div>
                <div class="bl-header-tip">
                    <i class="fa fa-volume-up" aria-hidden="true"></i>
                    <ul class="bl-header-message">
                        <li class="bl-header-message-list">本站内容仅供学习和参阅，不做任何商业用途。</li>
                        <li class="bl-header-message-list">内容如有侵犯，请立即联系管理员删除</li>
                        <li class="bl-header-message-list">做了一些小调整，使之看起来更像博客。</li>
                    </ul>
                </div>
            </div>
            <nav class="bl-header-pc-nav">
                <ul class="bl-header-cate">
                    <li class="bl-header-cate-li nav-active"><a href="/">首页</a></li>
                    <li class="bl-header-cate-li"><a href="">说说</a></li>
                    <li class="bl-header-cate-li drop">
                        <a href="JavaScript:;" title="">分类<i class="fa fa-angle-down"></i></a>
                        <div class="drop-nav orange-text ">
                            <ul>
                                <li><a href="/category/28">编程开发</a></li>
                                <li><a href="/category/29">系统架构</a></li>
                                <li><a href="/category/30">前端设计</a></li>
                                <li><a href="/category/31">修炼之道</a></li>
                                <li><a href="/category/32">程序人生</a></li>
                                <li><a href="/category/35">千锤百炼</a></li>
                                <li><a href="/category/33">黑客帝国</a></li>
                                <li><a href="/category/34">搜索引擎</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="bl-header-cate-li"><a href="/home/photo" title="">相册</a></li>
                    <li class="bl-header-cate-li"><a href="/home/resource" title="">素材</a></li>
                    <li class="bl-header-cate-li"><a href="/home">留言</a>	</li>
                    <li class="bl-header-cate-li"><a href="/home/about">关于</a></li>
                </ul>
            </nav>
        </div>
    </header>
@stop