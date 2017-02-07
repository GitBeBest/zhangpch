<div class="art-add">
    <div class="container">
        <form id="art-form" role="form">
            <div class="form-group">
                <label for="title">标题：</label>
                <input id="art-title" type="text" class="form-control" name="title" placeholder="请输入标题"/>
            </div>
            <div class="form-group">
                <label for="resume">简要：</label>
                <input id="art-resume" type="text" class="form-control" name="resume" placeholder="请输入摘要"/>
            </div>
            <div class="form-group">
                <label for="content">内容：</label>
                <input id="art-content" type="text" class="form-control" name="content" />
            </div>
            <div class="form-group dropdown">
                <label for="category">归类：</label>
                <div  id="dropDown_menu" class=" dropdown-toggle" data-toggle="dropdown">
                    <input id="art-category" id="art-cate-index" type="hidden" class="form-control" name="category" value="0"/>
                    <input id="art-cate-title" type="btn" class="btn" value="请选择"/>
                </div>
                <ul id="art-cate-menu" class="dropdown-menu" role="menu" aria-labelledby="dropDown_menu">
                    <li role="presentation">
                        <a role="menuitem" tabindex="1" href="#">Nginx</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="2" href="#">服务端</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="3" href="#">存储</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="4" href="#">前端</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="5" href="#">其他</a>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <label for="content">封面图片：</label>
                <input id="art-img" type="text" class="form-control" name="content" />
                <img id="art-img-pre" src="" style="width: 20%;height: 100px"/>
            </div>
            <button id="art-publish" class="btn btn-default">发布</button>
            <button id="art-store" class="btn btn-default">存稿</button>
        </form>
    </div>
</div>