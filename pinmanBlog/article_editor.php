<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=gbk"/>
</head>
<body>
<?php
include_once('conn.php');
$article_id=$_GET['article_id'];
$db=connect();
$query="select * from header where postid=".$article_id."";
$result=$db->query($query);
$row=$result->fetch_assoc();
echo "<form action='edit_article.php?article_id=".$article_id."' method='post' enctype='multipart/form-data'>";
echo "<span>标题：</span><input type='text' name='title' size='60' value='".$row['title']."'/>";
echo "<br/>";
echo "<span>作者：</span><input type='text' name='author' size='60' value='".$row['poster']."'/>";
echo "<p>摘要:</p>";
echo "<textarea rows='5' cols='60' name='description'>".$row['description']."</textarea>";
echo "<br/>";
echo "分类";
echo "<select name='group'>";
$cate=$row['cate'];
$query='select * from category';
$result=$db->query($query);
$num_result=$result->num_rows;
for($i=0;$i<$num_result;$i++){
  $row=$result->fetch_assoc();
  if($row['value']==$cate){
    echo "<option selected value='".$row['value']."'>".$row['name']."</option>";
	}
  else{
    echo "<option  value='".$row['value']."'>".$row['name']."</option>";
    }
  }
echo "</select><br/>";
echo "上传封面:<input type='file' name='cover' size='30'><br/>";
$query="select * from body where postid=".$article_id."";
$result=$db->query($query);
$row=$result->fetch_assoc();
echo "<p>正文:</p><textarea name='body' rows='10' cols='60'>".$row['message']."</textarea><br/>";
$query="select name from tag,article_tag where tag.tagid=article_tag.tagid and postid='".$article_id."'";
$result=$db->query($query);
$num_result=$result->num_rows;
$tags=array();
for($i=0;$i<$num_result;$i++){
  $row=$result->fetch_assoc();
  $tags[$i]=$row['name'];
}
echo "标签(可选):";
$query='select * from tag';
$result=$db->query($query);
$num_result=$result->num_rows;
for($i=0;$i<$num_result;$i++){
  $row=$result->fetch_assoc();
  if(in_array($row['name'],$tags)){
  echo "<input type='checkbox' checked name='tags[]' value='".$row['name']."'/>".$row['name'];
  }
  else{
  echo "<input type='checkbox' name='tags[]' value='".$row['name']."'/>".$row['name'];
  }
}
echo "<br/><input type='submit' name='article_submit' value='编辑完成'/></form>";
echo "</form>";
echo "<form action='add_tag.php' method='post'>";
echo "<span>新建标签(可选)：</span><input type='text' size='10' name='new_tag'/>";
echo "<input type='submit' value='生成新标签'/>";
echo "</form>";
?>
</body>
</html>
