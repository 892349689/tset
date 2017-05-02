<?php
namespace Home\Controller\User;
session_start();
use Think\Controller;
use Think\Model;
class UserController extends Controller{
   private $userModel;
   private $clientModel;
   private $employeeModel;
   private $amendModel;
   private $complainModel;
   private $housesModel;
   private $scheduleModel;
   public function __construct(){
       parent::__construct();
       $this->userModel = D("employee"); //new Model("employee");
       $this->clientModel = new Model("client");
       $this->employeeModel = new Model("employee");
       $this->amendModel = new Model("job");
       $this->complainModel = new Model("complain");
       $this->housesModel = new Model("houses");
       $this->scheduleModel = new Model("schedules");
   }
   
   /**
    * 登录
    */
   public function login($userName,$pwd){
//         $userName = $_POST["userName"];
//         $pwd = $_POST["pwd"];
        
       //查询数据
       $users = $this->userModel->where("userName='$userName'")->select();
       
       $host = $_SERVER["HTTP_HOST"];
       
       if (count($users)>0){
           $u = $users[0];
           if ($pwd==$u["userpass"]){
               $_SESSION["loginuser"]=$u;
               //查询用户拥有的菜单
               $menus = $this->userModel->table("employeejob ej,jobmenu jm,menu m")
               ->field("m.*")
               ->where("ej.eid = jm.eid AND m.mid = jm.mid AND ej.eid=".$u["eid"])
               ->select();
               $_SESSION["menus"]=$menus;
               $_SESSION["userName"]=$userName;
//               print_r($userName);
               //密码正确
               //header("location:http://".$host."/think/easyuiwelcome.php");
               $this->assign("NB",NBSP);
               $this->display("welcome");
           }else {
               $_SESSION["loginError"]="密码错误";
               header("location:http://".$host."/think/login.php");
           }
       }else {
           $_SESSION["loginError"]="用户名不纯在";
           header("location:http://".$host."/think/login.php");
       }
   }
   
   
   /**
    * 查询客户列表
    */
   public function userlist($pageNo=1,$pageSize=10,$searchename=null,$searchephone=null){
      //$query = "1=1 ";  
      $query = array();
      if ($searchename != null && $searchename != ""){
          //$query .= "and userName like '%$searchename%'";
          $query["cname"] = array("LIKE","%$searchename%");
      }
      if ($searchephone != null && $searchephone != ""){
          //$query .= "and userphone like '%$searchephone%'";
          $query["phone"] = array("LIKE","%$searchephone%");
      }
      $total = $this->clientModel->where($query)->count();      
      $rows = $this->clientModel->where($query)->page($pageNo,$pageSize)->select();
      $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
      $this->ajaxReturn($page);
   }
   /**
    * 同步请求
    * @param number $pageNo
    * @param number $pageSize
    */
   public function empuser($pageNo=1,$pageSize=10){
       $total = $this->employeeModel->getField("count(*)");
       $rows = $this->employeeModel->page($pageNo,$pageSize)->select();
       $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->assign("page",$page);
       $this->assign("NB",NBSP);
       $this->display("empuser");
   }
   
   /**
    * 查询员工列表 异步请求
    * @param number $pageNo
    * @param number $pageSize
    */
   public function employee($pageNo=1,$pageSize=10){
     $total = $this->employeeModel->getField("count(*)");
     $rows = $this->employeeModel->page($pageNo,$pageSize)->select();
     $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
     $this->ajaxReturn($page);
   }
   /**
    * 查询权限列表
    * @param number $pageNo
    * @param number $pageSize
    */
   public function amend($pageNo=1,$pageSize=10){
       $total = $this->amendModel->getField("count(*)");
       $rows = $this->amendModel->page($pageNo,$pageSize)->select();
       $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->ajaxReturn($page);
   }
   /**
    * 查询投诉列表
    * @param number $pageNo
    * @param number $pageSize
    */
   public function complain($pageNo=1,$pageSize=10){
       $total = $this->complainModel->getField("count(*)");
       $rows = $this->complainModel->page($pageNo,$pageSize)->select();
       $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->ajaxReturn($page);
   }
   /**
    * 查询楼盘列表
    * @param number $pageNo
    * @param number $pageSize
    */
   public function houses($pageNo=1,$pageSize=10,$searchearea=NULL,$searcheprice=NULL){
       $query = array();
       if ($searchearea != null && $searchearea != ""){
           $query["area"] = array("LIKE","%$searchearea%");
       }
       if ($searcheprice != null && $searcheprice != ""){
           $query["price"] = array("LIKE","%$searcheprice%");
       }
       $total = $this->housesModel->where($query)->count();
       $rows = $this->housesModel->where($query)->page($pageNo,$pageSize)->select();
       $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->ajaxReturn($page);
   }
   
   /**
    * 查询日程列表
    * @param number $pageNo
    * @param number $pageSize
    */
   public function schedules($pageNo=1,$pageSize=10){
       $total = $this->scheduleModel->getField("count(*)");
       $rows = $this->scheduleModel->page($pageNo,$pageSize)->select();
       $page = array("total"=>$total,"rows"=>$rows,"pageNo"=>$pageNo,"pageSize"=>$pageSize);
       $this->ajaxReturn($page);
   }
   /**
    * 客户的增加修改
    */
   public function client(){
       $data = $this->clientModel->create();
       if ($data["cid"]< 0){
           $this->clientModel->field("c_id,cname,sex,phone,site,state,claim,eid")->add();
       }else {
           $this->clientModel->field("c_id,cname,sex,phone,site,state,claim,eid")->where("cid=%d", $data["cid"])->save();
       }
       $this->userlist();
   }
   /**
    * 删除员工
    */
   public function clientdel(){
       $cid = $_POST["cid"];
       for ($i = 0;$i<count($cid);$i++){
           $this->clientModel->delete("$cid[$i]");
       }
       $this->userlist();
   }
   /**
    * 楼盘的增加修改
    */
   public function housesup(){
       $data = $this->housesModel->create();
       if ($data["hid"]< 0){
           $this->housesModel->field("area,developers,plot,price")->add();
       }else {
           $this->housesModel->field("area,developers,plot,price")->where("hid=%d", $data["hid"])->save();
       }
       
       $this->houses();
   }
   public function textView(){
       $this->assign("aaa","大重庆");
       $this->assign("ccc",time());
       $this->assign("bbb",array(0=>"123",1=>"789","aaa"=>"周星期"));
       $this->display();
       
   }
   public function findempuser(){
       $data = $this->employeeModel->create();
       if ($data["eid"]< 0){
           $this->employeeModel->field("eid,userName,userPass,userphone")->add();
       }else {
           $this->employeeModel->field("eid,userName,userPass,userphone")->where("eid=%d", $data["eid"])->save();
       } 
       $this->empuser();
   }
   public function loadempuser($eid){
       $data=$this->employeeModel->find($eid);
       $this->ajaxReturn($data);
   }
  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
}

?>