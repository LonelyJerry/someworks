<?php
//��������б�
include('conn.php');
function cate_list(){
$db=connect();
$query="select * from category";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
}
echo "<ul>";
echo "<li><a href='index.php'>��������</a></li>";
$num_result=$result->num_rows;
for($i=0;$i<$num_result;$i++){
  $row=$result->fetch_assoc();
  echo "<li><a href='index.php?cate=".$row['value']."'>".$row['name']."</a></li>";
  }
}
echo "</ul>";
?>