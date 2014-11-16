<?php
/*给文章添加评论*/
//引入数据库连接模块
include('conn.php');
$db=connect();

$name=$_POST['yourname'];//评论者昵称
$email=$_POST['youremail'];//评论者邮箱
//通过get方法获取文章的id号;
$parent=$_GET['postid'];
$date=date("Y-m-d");//评论日期
$body=$_POST['commend_body'];//评论内容
//评论者的头像是可选的，如果选择了头像则获取所选头像
if(isset($_POST['icon'])){
  $icon=$_POST['icon'].".jpg";
  }
//评论者没选择头像时使用默认头像
else{
  $icon="default.jpg";
  }

if(!$name||!$email||!$body){
  echo "请填写完整评论信息";
  exit;
  }
//防止SQL注入
if(!get_magic_quotes_gpc()){
  $name=addslashes($name);
  $email=addslashes($email);
  $body=addslashes($body);
  }
/*向commend表中添加评论信息*/
//"insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent.",'',0)"
$query="insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent.",NULL,0)";
$result=$db->query($query);
if(!$result){
  echo "失败".$db->error;
  return false;
  exit;
  }
//返回所评论的文章的页面  
header("location:article.php?postid=".$parent);  
?>
