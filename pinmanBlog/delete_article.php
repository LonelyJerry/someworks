<?php
include_once('conn.php');
$id=$_GET['article_id'];
$db=connect();
$query="delete from header where postid=".$id."";
$result=$db->query($query);
if(!$result){
  echo "失败".$db->error;
  return false;
  exit;
}
$query="delete from commend where article_father=".$id."";
$result=$db->query($query);
if(!$result){
  echo "失败".$db->error;
  return false;
  exit;
}
?>
