<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=gbk"/>
</head>
<body>
<form action="add_article.php" method="post" enctype="multipart/form-data">
<span>���⣺</span><input type="text" name="title" size="60"/>
<br/>
<span>���ߣ�</span><input type="text" name="author" size="60"/>
<br/>
<p>ժҪ:</p>
<textarea rows="5" cols="60" name="description"></textarea>
<br/>
���ࣺ
<select name="group">
<option value="fight">��Ѫս��</option>
<option value="sports">��������</option>
<option value="detective">������</option>
<option value="funny">��ֱ�Ц</option>
<option value="love">�ഺ����</option>
</select>
<br/>
�ϴ�����:<input type="file" name="cover" size="30">
<br/>
<p>����:</p>
<textarea name="body" rows="5" cols="60"></textarea>
<br/>
��ӱ�ǩ(��ѡ):
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
<input type="checkbox" name="tags[]" value="��Ӱ����"/>��Ӱ����
<input type="checkbox" name="tags[]" value="yy��"/>yy��
<input type="checkbox" name="tags[]" value="���ӵ�����"/>���ӵ�����
<input type="checkbox" name="tags[]" value="���ݵ�"/>���ݵ�
-->
<br/>
<input type="submit" name="article_submit" value="ȷ���������"/>
</form>
<form action="add_tag.php" method="post">
<span>�½���ǩ(��ѡ)��</span><input type="text" size="10" name="new_tag"/>
<input type="submit" value="�����±�ǩ"/>
</form>
</body>
</html>
