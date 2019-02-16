<?php
class CzzAction extends BaseAction{
    public function index(){
       
        
        $token      = $this->_get('token'); 
		$gamereply_info_db=M('czzreply_info');
		$info=$gamereply_info_db->where(array('token'=>$this->token))->find();
		$this->assign('info',$info);

      //  $this->assign('isAndroid',isAndroid());
        $this->display();
    }
    
}
    
?>