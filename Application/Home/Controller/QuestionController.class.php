<?php
namespace Home\Controller;
use Think\Controller;
class QuestionController extends Controller {
    //Moi首页
	public function index(){
        $Question = M("Question");
		$question_list = $Question->field('q,a')
			->where('open_id='.$open_id)->select();
		$this->assign("question_list",$question_list);
		$this->display();
    }
	
	public function aboutus(){
		$SiteConst = M("SiteConst");
		$aboutus = $SiteConst->getByName('aboutus');
		$this->assign("about_us",$aboutus);
		$this->display();
	}
}