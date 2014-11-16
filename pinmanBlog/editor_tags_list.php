<?php
include_once('conn.php');

function editor_tags_list($db){
  $query="select * from tag";
  $result=$db->query($query);
  $num_result=$result->num_rows;
  for($i=0;$i<$num_result;$i++){
    $row=$result->fetch_assoc();
	echo "<li>";
	echo "<a href='index.php?tag=".$row['name']."'>";
	echo $row['name'];
	echo "</a>";
	echo "</li>";
	echo "<form name='delete_tag' action='delete_tag.php?tag_id=".$row['tagid'].
	     "' method='post'><input type='submit' value='删除'></form>";
	}
}
?>
