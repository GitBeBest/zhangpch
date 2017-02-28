<?php namespace modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Home\Entities\Article;

class ArticleController extends Controller {

    /***********************前台页面*********************************************/
    /**
     * 首页
     */
	public function index()
	{
		return view('home::category');
	}

    /**
     * 不同分类
     * @param $id
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function cate($id, $page = 1){
	    $data = Article::where('category_id', $id)->paginate(15);
	    return view('home::category', ['article' => $data, 'type' => $id]);
    }

    /***********************管理员页面******************************************/
    public function addArticle() {
        return view('home::b_article');
    }

    /***********************API接口********************************************/

    /**
     * 获取文章详情
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function detail($id){
        $model = Article::find($id);
        $model->view_times += 1;
        $model->save();
        return view('home::article', ['article' => $model, 'type' => $model->category_id]);
    }


    /**
     * 添加文章
     */
    public function add(){
        $title = Input::get('title');
        $resume = Input::get('resume');
        $content = Input::get('content');
        $category = Input::get('category');
        $link_img = Input::get('link_img');
        $status = Input::get('status');

        $data = [
            'title' => $title,
            'resume' => $resume,
            'content' => $content,
            'category' => $category,
            'link_img' => $link_img,
            'status' => $status
        ];
        $model = Article::create($data);

        if($model) {
            return $this->JsonOutPut();
        } else{
            return $this->JsonOutPut([], 1);
        }
    }

    /**
     * 更新文章
     */
    public function update() {
        $id = Input::get('id');
        $title = Input::get('title');
        $resume = Input::get('resume');
        $content = Input::get('content');
        $category = Input::get('category');
        $link_img = Input::get('link_img');

        $model = Article::find($id);
        if($model) {
            $model->title = $title;
            $model->resume = $resume;
            $model->content = $content;
            $model->category = $category;
            $model->link_img = $link_img;
            $model->save();
            return $this->JsonOutPut();
        } else{
            return $this->JsonOutPut([], 'no', '文章未找到');
        }
    }

    /**
     * 删除文章
     */
    public function delete(){
        $id = Input::get('id');
        $model = Article::find($id);
        if($model) {
            $model->delete();
            return $this->JsonOutPut();
        }else{
            return $this->JsonOutPut([], 'no', '文章未找到');
        }
    }

    /**
     * 文章点赞
     * @return static
     */
	public function praise(){
        $id = Input::get('id');
        $model = Article::find($id);
        if($model) {
            $model->praise_times += 1;
            $model->save();
            return $this->JsonOutPut(['times' => $model->praise_times]);
        }else{
            return $this->JsonOutPut([], 'no', '文章未找到');
        }
    }

    /**
     * 文章鄙视一下
     * @return static
     */
    public function hate() {
        $id = Input::get('id');
        $model = Article::find($id);
        if($model) {
            $model->hate_times += 1;
            $model->save();
            return $this->JsonOutPut(['times' => $model->hate_times]);
        }else{
            return $this->JsonOutPut([], 'no', '文章未找到');
        }
    }
}