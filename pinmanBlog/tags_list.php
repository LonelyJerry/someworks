<?php
include_once('conn.php');
//该函数的作用为显示所有标签
function tags_list(){
  $db=connect();
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
	}
}
?>