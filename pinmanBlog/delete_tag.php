<?php
include_once('conn.php');
$id=$_GET['tag_id'];
$db=connect();
$query="delete from tag where tagid=".$id."";
$result=$db->query($query);
if(!$result){
  echo "Ê§°Ü".$db->error;
  return false;
  exit;
}
header("location:editor.php");
?>