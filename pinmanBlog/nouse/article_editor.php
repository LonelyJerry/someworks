<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=gbk"/>
</head>
<body>
<form action="add_article.php" method="post" enctype="multipart/form-data">
<span>标题：</span><input type="text" name="title" size="60"/>
<br/>
<span>作者：</span><input type="text" name="author" size="60"/>
<br/>
<p>摘要:</p>
<textarea rows="5" cols="60" name="description"></textarea>
<br/>
分类：
<select name="group">
<option value="fight">热血战斗</option>
<option value="sports">体育竞技</option>
<option value="detective">推理斗智</option>
<option value="funny">搞怪爆笑</option>
<option value="love">青春恋爱</option>
</select>
<br/>
上传封面:<input type="file" name="cover" size="30">
<br/>
<p>正文:</p>
<textarea name="body" rows="5" cols="60"></textarea>
<br/>
添加标签(可选):
<?php
include('conn.php');
$db=connect();
$query='select * from tag';
$result=$db->query($query);
$num_result=$result->num_rows;
for($i=0;$i<$num_result;$i++){
  $row=$result->fetch_assoc();
  echo "<input type='checkbox' name='tags[]' value='".$row['name']."'/>".$row['name'];
  }
?>
<!--
<input type="checkbox" name="tags[]" value="火影忍者"/>火影忍者
<input type="checkbox" name="tags[]" value="yy党"/>yy党
<input type="checkbox" name="tags[]" value="黑子的篮球"/>黑子的篮球
<input type="checkbox" name="tags[]" value="考据党"/>考据党
-->
<br/>
<input type="submit" name="article_submit" value="确认添加文章"/>
</form>
<form action="add_tag.php" method="post">
<span>新建标签(可选)：</span><input type="text" size="10" name="new_tag"/>
<input type="submit" value="生成新标签"/>
</form>
</body>
</html>
