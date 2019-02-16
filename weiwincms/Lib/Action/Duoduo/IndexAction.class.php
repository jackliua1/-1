<?php
class IndexAction extends  Action{
    public $token;
    public $product_model;
    public $product_cat_model;
    public $isDining;
//    public function _initialize() {
//        parent::_initialize();
//        //
//        $token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
//        if((!intval($_GET['dining'])&&!strpos($token_open['queryname'],'shop')) || (intval($_GET['dining'])&&!strpos($token_open['queryname'],'dx'))){
//            $this->error('您还未开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
//        }
//        //是否是餐饮
//        if (isset($_GET['dining'])&&intval($_GET['dining'])){
//            $this->isDining=1;
//        }else {
//            $this->isDining=0;
//        }
//        $this->assign('isDining',$this->isDining);
//    }

//新房
    public function lists(){
        if($_GET){

            $model=M('product');
            $token=array('token'=>$_GET['token'],'catid'=>$_GET['catid']);
            $data=$model->where($token)->order('id desc') ->select();
            $datas=$model->where($token)->limit('4')->order('id desc')->select();

            $this->assign('date',$datas);
            $this->assign('cats',$data);
        }
        $count      = $model->where($token)->count();
        $Page       = new Page($count,20);
        $show       = $Page->show();
        $list = $model->where($token)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }


//二手房
        public function  house(){

            if($_GET){

                $model=M('product');
                $token=array('token'=>$_GET['token'],'catid'=>$_GET['catid']);
                $data=$model->where($token)->select();
                $datas=$model->where($token)->limit('4')->order('id desc')->select();
                $this->assign('date',$datas);
                $this->assign('cats',$data);
            }
            $count      = $model->where($token)->count();
            $Page       = new Page($count,20);
            $show       = $Page->show();
            $list = $model->where($token)->limit($Page->firstRow.','.$Page->listRows)->select();

            $this->assign('page',$show);
            $this->assign('list',$list);
            $this->display();
        }

    /**
     * @return mixed
     */
    public function details()
    {
        if($_GET){
            $model=M('product');
            $token=array('token'=>$_GET['token'],'id'=>$_GET['id']);
            $data=$model->where($token)->find();
            $this->assign('data',$data);
        }
        $this->display();
    }


}