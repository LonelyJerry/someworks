<?php
include_once('conn.php');
include_once('article_tag.php');

function show_article($db,$postid){
$img_address="img/";
$query="select * from header where postid=".$postid."";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
  }
$row=$result->fetch_assoc();
echo "<h1>".$row['title']."</h1>";
echo "<div class='intro'> ";
echo "<span>����:".$row['poster']."</span>";
echo "<span>���ڣ�".$row['posted']."</span>";
echo "<span>���ࣺ".$row['cate']."</span>";
echo "<span style='margin-right:5px;'>��ǩ:</span>";
echo "<ul>";
echo article_tag($db,$postid,"li");
echo "<div class='clearfix'></div>";
echo "</ul>";
echo "</div>";
echo "<img src='".$img_address.$row['cover']."'/>";

$query="select message from body where postid=".$postid."";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
  }
$row=$result->fetch_assoc();
echo  "<p class='text'>".$row['message']."</p>";
echo  "<a  id='check_commends' onclick='check_commend()'>����<span>(2)</span></a>";
echo  "<a  id='add_commend' onclick='add_commend()'>��ҲҪ����</a>";
}
?>