<?php
include_once('conn.php');
//引入树节点类
include_once('treenode_class.php');
$article_id=$_GET['article_id'];
$db=connect();
$query="select * from commend where article_father=".$article_id." AND commend_father is NULL";
$result=$db->query($query);
  if(!$result){
    return false;
	exit;
  }
  $result_num=$result->num_rows;
  for($i=0;$i<$result_num;$i++){
    $row=$result->fetch_assoc();
	$tree=new treenode($row['id'],$row['name'],$row['date'],$row['icon'],$row['children'],$row['body'],$article_id,null);
	$tree->display_for_commend_edit();
	}
?>