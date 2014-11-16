<?php
/*对评论进行回复*/
include_once('conn.php');
//连接数据库
$db=connect();
//通过get方法获取评论的id号;
$id=$_GET['commend_id'];
$parent_id=$_GET['article_id'];//通过get方法评论所在页面
$name=$_POST['yourname'];//评论者的姓名
$email=$_POST['youremail'];//评论者的邮箱
$date=date("Y-m-d");//评论日期
$body=$_POST['commend_body'];//评论内容
//头像可选，如果选择了头像则使用头像
if(isset($_POST['icon'])){
  $icon=$_POST['icon'].".jpg";
  }
//如果没选头像则使用默认头像
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
/*向commends表中添加对评论的评论*/
//insert into commend values ('','$name','$email','$icon','$body','$date',$parent_id,$id,0)
$query="insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent_id.",".$id.",0)";
$result=$db->query($query);
if(!$result){
  echo "失败".$db->error;
  return false;
  exit;
  }
//被评论的评论需要改变其被评论次数
$query="select * from commend where commend_father=".$id."";
$result=$db->query($query);
$children_num=$result->num_rows;
echo $children_num;
$query="update commend set children=".$children_num." where id=".$id."";
$result=$db->query($query);
if(!$result){
  echo "失败".$db->error;
  return false;
  exit;
  }
//返回评论所在的文章页面
header("location:article.php?postid=".$parent_id);  
?>
