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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function cate($id){
	    $data = Article::where('category', $id)->get();
	    return view('home::category');
    }

    /***********************管理员页面******************************************/
    public function addArticle() {
        return view('home::b_article');
    }

    /***********************API接口********************************************/
     /**
     * 获取文章
     */
	public function lists(){
	    $data = Article::all();
        return $this->JsonOutPut($data);
    }

    /**
     * 获取文章详情
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function detail($id){
        $data = Article::find($id);
        return view('home::article', ['article' => $data]);
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

        $data = [
            'title' => $title,
            'resume' => $resume,
            'content' => $content,
            'category' => $category,
            'link_img' => $link_img
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

	
}