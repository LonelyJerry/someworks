<?php
/*添加评论*/
include('conn.php');
$db=connect();

$new=$_POST['new_tag'];//新标签的名称
if(!$new){
  echo "请输入新的标签";
  exit;
  }
//防止SQL注入
if(!get_magic_quotes_gpc()){
  $new=addslashes($new);
  }
//检查新添加的标签名是否已经存在
$query="select * from tag where name='".$new."'";
$result=$db->query($query);
if(!$result){
  return false;
  }
  
if($result->num_rows>0){
  echo "该标签已存在";
  exit;
  }
//向tag表添加新的标签信息
else{
  $query="insert into tag values('','".$new."')";//insert into tag values('','$new');
  $result=$db->query($query); 
  if(!$result){
    return false;
    }
  }
//返回仪盘表页面
header("location:editor.php");
?>