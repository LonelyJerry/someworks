<?php
//根据《PHP和MYSQL开发》中第586页的代码编写
include_once('conn.php');

class treenode{
  public $m_postid;//评论的id
  //public $m_title;//评论的标题，这个可以不要
  public $m_poster;//评论者
  public $m_posted;//评论时间
  public $m_icon;//评论者头像
  public $m_children;//评论的子评论数
  public $m_body;//评论内容
  public $m_childlist;//子评论数组
  public $m_article;//评论所属文章
  public $m_father;//评论的父评论的评论者名称
  
  public function __construct($postid,$poster,$posted,$icon,
       $children,$body,$article,$father){
    $this->m_postid=$postid;
	//$this->m_title=$title;
	$this->m_poster=$poster;
	$this->m_posted=$posted;
	$this->m_icon=$icon;
	$this->m_children=$children;
	$this->m_body=$body;
	$this->m_childlist=array();
	//$this->m_depth=$depth;
	$this->m_article=$article;
	$this->m_father=$father;
	
	
	if($children>0){
	  $db=connect();
	  $query="select * from commend where commend_father =".$postid." order by date ASC";
	  $result=$db->query($query);
	  
	 
	  if(!$result){
       return false;
	   echo "失败";
	   exit;
       }
	  $query2="select name from commend where id=".$postid."";
	  $result2=$db->query($query2);
	  $row=$result2->fetch_assoc();
	  $father=$row['name'];
	  //获得评论的子评论,并将子评论生成treenode类
	  for($count=0;$r=$result->fetch_assoc();$count++){
		$this->m_childlist[$count]=new treenode($r['id'],$r['name'],$r['date'],$r['icon'],$r['children'],$r['body'],$article,$father);
	  }
	}
  }
  
  function display(){
    $img_address="img/";
	
	  echo "<div class='commend'>";
	  echo "<img class='touxiang' src='".$img_address.$this->m_icon."'/>";
	  echo "<div class='say'>";
	  echo "<p class='name'>".$this->m_poster;
	  if($this->m_father!=null)
	  {echo "&nbsp对&nbsp".$this->m_father."评论";}
	  echo "</p>";
	  echo "<p>".$this->m_body."</p>";
	  echo "<a class='commend_for_commend'>评论该评论</a>";
	  if($this->m_children>0){
        echo "<a class='commends'>该评论下的评论(".$this->m_children.")</a>";
		}
	  echo "</div>";
	  echo "<p class='date clearfix' style='margin-left:10px;'>".$this->m_posted."</p>";
	  echo "<div class='commend_for_commend_area'>";
	  echo "<form method='post' action='add_commend_for_commend.php?commend_id=".$this->m_postid."&article_id=".$this->m_article."'></form>";
	  echo "</div>";
	  echo "<div class='commends_for_thiscommend'>";
	  //对评论的子评论递归调用display()方法
      $num_children=$this->m_children;
	  for($i=0;$i<$num_children;$i++){
	    @$this->m_childlist[$i]->display();
	  }
	  echo "</div>";
	  echo "</div>"; 
      
	
	}
   function display_for_commend_edit(){
      echo "<p style='dispaly:inline' class='name'>".$this->m_poster;
	  if($this->m_father!=null)
	  {echo "&nbsp对&nbsp".$this->m_father."评论";}
	  echo ":</p>";
	  echo "<p style='dispaly:inline'>".$this->m_body."</p>";
	  echo "<p class='date clearfix' style='margin-left:10px;'>".$this->m_posted."</p>";
	  echo "<form name='delete_commend' action='delete_commend.php?commend_id=".$this->m_postid."&article_id=".$this->m_article.
	     "' method='post'><input type='submit' value='删除'></form>";
	  $num_children=$this->m_children;
	  for($i=0;$i<$num_children;$i++){
	    @$this->m_childlist[$i]->display_for_commend_edit();
	  }
	  
   }
}