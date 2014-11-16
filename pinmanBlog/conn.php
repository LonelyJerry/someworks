<?php
/*该函数的作用为连接数据库*/
function connect(){
  $host="localhost";
  $user="root";
  $password="";
  $dbase_name="pinman";
  @ $db=new mysqli($host,$user,$password,$dbase_name);
  if(mysqli_connect_errno()){
    echo '连接数据库失败';
	exit;
  }
  else{
  //echo "连接成功";
  }
//echo @"mysql服务器：$host用户名：$user<br>";

//echo"数据库:$dbase_name<br>";
//echo"连接mysql数据库成功";
  $db->query("set names gbk");
  return $db;
}
?>