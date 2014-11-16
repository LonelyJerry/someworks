<?php
include_once('conn.php');
$id=$_GET['commend_id'];
$article_id=$_GET['article_id'];
$db=connect();
$query="select commend_father from commend where id=".$id."";
$result=$db->query($query);
if(!$result){
  echo "Ê§°Ü".$db->error;
  return false;
  exit;
}
$row=$result->fetch_assoc();
$father=$row['commend_father'];

$query="delete from commend where id=".$id."";
$result=$db->query($query);
if(!$result){
  echo "Ê§°Ü".$db->error;
  return false;
  exit;
}
$query="select * from commend where commend_father=".$father."";
$result=$db->query($query);
$children_num=$result->num_rows;
$query="update commend set children=".$children_num." where id=".$father."";
$result=$db->query($query);
if(!$result){
  echo "Ê§°Ü".$db->error;
  return false;
  exit;
  }
header("location:commend_edit.php?article_id=".$article_id);
?>