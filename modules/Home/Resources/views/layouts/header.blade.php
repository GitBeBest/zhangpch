@section('header')
    <header class="bl-header">
        <div class="bl-header-top">
            <div class="bl-header-top-left">
                <div class="bl-header-logo">
                    <a href="/">
                        <img src="/modules/home/images/logo.gif">
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
                    <li class="bl-header-cate-li {{ isset($type)&& $type > 0 ? '' : 'nav-active' }}"><a href="/">首页</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 1 ? 'nav-active' : ''  }}"><a href="/nginx">Nginx</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 2 ? 'nav-active' : ''  }}"><a href="/server">服务端</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 3 ? 'nav-active' : ''  }}"><a href="/cache">存储</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 4 ? 'nav-active' : ''  }}"><a href="/front">前端</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 5 ? 'nav-active' : ''  }}"><a href="/other">其他</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 99 ? 'nav-active' : ''  }}"><a href="/message">留言</a></li>
                    <li class="bl-header-cate-li {{ isset($type)&& $type == 100 ? 'nav-active' : ''  }}"><a href="/about">关于</a></li>
                </ul>
            </nav>
        </div>
    </header>
@stop