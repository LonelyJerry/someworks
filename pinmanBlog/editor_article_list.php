<?php
include_once('conn.php');
function editor_article_list(){
    $db=connect();
    $query="select * from header limit 6 ";
    $result=$db->query($query);
    $num_result=$result->num_rows;
    for($i=0;$i<$num_result;$i++){
      $row=$result->fetch_assoc();
	  echo "<div class='article'>";
	  echo "<h1 class='title'>标题：<a target='_blank' href='article.php?postid=".$row['postid']."'>".stripslashes($row['title'])."</a></h1>";
	  echo "<p class='description'>摘要：".stripslashes($row['description'])."</p>";
	  echo "<p class='date'>发布日期：".stripslashes($row['posted'])."</p>";
	  echo "<form action='article_editor.php?article_id=".$row['postid']."' method='post'><input  style='float:left;margin-right:10px;'type='submit' value='编辑'></form>";
	  echo "<form action='delete_article.php?article_id=".$row['postid']."' method='post'><input style='float:left;margin-right:10px;' type='submit' value='删除'></form>";
	  echo "<form action='commend_edit.php?article_id=".$row['postid']."' method='post'><input style='float:left;' type='submit' value='评论管理'></form>";
	  echo "</div>";
	  echo "<div class='clearfix'></div>";
	  echo "<br/>";
	  
}
}	  
?>