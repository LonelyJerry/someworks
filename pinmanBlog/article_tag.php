<?php
include_once("conn.php");
//该函数的作用是显示文章相关标签,其中postid变量为文章id，html变量为输出标签时使用的html标签，如：需要使用<li>标签时,html变量为li
function article_tag($db,$postid,$html){
  //根据article_tag文章标签关系表，在tag表中找出文章相关的标签
  $db=connect();
  $query="select name from tag,article_tag where tag.tagid=article_tag.tagid and postid='".$postid."'";
  $result=$db->query($query);
  $num_result=$result->num_rows;
  for($i=0;$i<$num_result;$i++){
    $row=$result->fetch_assoc();
	echo "<".$html.">";
	echo "<a href='index.php?tag=".$row['name']."'>";
	echo $row['name'];
	echo "</a>";
	echo "</".$html.">";
	}
}
?>
  
