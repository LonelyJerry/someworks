<?php
include_once('conn.php');
//引入树节点类
include_once('treenode_class.php');

function show_commend_for_article($db,$postid){
  $img_address='img/';
  $query="select * from commend where article_father=".$postid." AND commend_father is NULL";
  $result=$db->query($query);
  if(!$result){
    return false;
	exit;
  }
  $result_num=$result->num_rows;
  for($i=0;$i<$result_num;$i++){
    $row=$result->fetch_assoc();
	$tree=new treenode($row['id'],$row['name'],$row['date'],$row['icon'],$row['children'],$row['body'],$postid,null);
	$tree->display();
	}
  
}
?>