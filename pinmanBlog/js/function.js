function add_commend()
{
add_commend_area=document.getElementById("add_commend_area");
commend_area=document.getElementById("commend_area");
add_commend_area.style.display="block";
commend_area.style.display="none";
}

function check_commend()
{
add_commend_area=document.getElementById("add_commend_area");
commend_area=document.getElementById("commend_area");
add_commend_area.style.display="none";
commend_area.style.display="block";
}


$(function(){
  $(".commend_for_commend").bind(
  "click",function(){
  if($(this).parent().next().next().css("display")=="none"){
  $(".commend_for_commend").parent().next().next().css("display","none");
  $(".commend_for_commend").parent().next().next().children().empty();
  $(this).parent().next().next().css("display","block");
  form=$(this).parent().next().next().children().append(
  "<p class='yourname'>你的昵称:</p>"+
  "<input name='yourname' size='60' placeholder='最多可输入30个中文字符或60个非中文字符'/><br/>"+
  "<p class='youremail' style='display:inline;margin-right:10px;'>你的邮箱:</p>"+
  "<input size='60' name='youremail'  placeholder='请填写你的邮箱，用于绑定你的昵称' />"+
  "<p class='yourtouxiang'>选择一个头像（可选）：</p>"+
  "<label for='lufei2'>"+
  "<img class='choose_touxiang' src='img/lufei.jpg'/>"+
  "</label>"+
  
  "<input type='radio' id='lufei2' class='touxiang_radio' name='icon' value='lufei'/>"+
  "<label for='qiya2'><img class='choose_touxiang' src='img/qiya.jpg' /></label>"+
  "<input type='radio' id='qiya2' class='touxiang_radio' name='icon' value='qiya'/>"+
  "<label for='mingren2'><img class='choose_touxiang' src='img/mingren.jpg' /></label>"+
  "<input type='radio' id='mingren2' class='touxiang_radio' name='icon' value='mingren'/>"+
  "<label for='gang2'><img class='choose_touxiang' src='img/gang.jpg' /></label>"+
  "<input type='radio' id='gang2' class='touxiang_radio' name='icon' value='gang'/>"+
  "<label for='heizi2'><img class='choose_touxiang' src='img/heizi.jpg' /></label>"+
  "<input type='radio' id='heizi2' class='touxiang_radio' name='icon' value='heizi'/>"+
  "<div class='text'>"+
  "<textarea name='commend_body' rows='8' cols='100' placeholder='在这里输入你想发表的评论，文明讨论，拒绝谩骂~' style='display:block;'></textarea>"+
  "<button type='submit' class='clearfix'>发表</button>"
   );
   $(".choose_touxiang").bind({
    mouseover:function(){$(this).css({"borderColor":"#ff611c","borderWidth":"5px","borderStyle":"solid"})},
	mouseout:function(){$(this).css({"borderColor":"","borderWidth":"","borderStyle":""})},
	click:function(){
	      $(".choose_touxiang").css({"borderColor":"","borderWidth":"","borderStyle":""}),
		  $(".choose_touxiang").bind("mouseout",function(){$(this).css({"borderColor":"","borderWidth":"","borderStyle":""})}),
	      $(this).css({"borderColor":"#ff611c","borderWidth":"5px","borderStyle":"solid"},
	      $(this).unbind("mouseout"))
		}
  });
  
   }
   else if($(this).parent().next().next().css("display")=="block"){
   $(this).parent().next().next().css("display","none");
   $(this).parent().next().next().children().empty();
   }
  });
  
   $(".choose_touxiang").bind({
    mouseover:function(){$(this).css({"borderColor":"#ff611c","borderWidth":"5px","borderStyle":"solid"})},
	mouseout:function(){$(this).css({"borderColor":"","borderWidth":"","borderStyle":""})},
	click:function(){
	      $(".choose_touxiang").css({"borderColor":"","borderWidth":"","borderStyle":""}),
		  $(".choose_touxiang").bind("mouseout",function(){$(this).css({"borderColor":"","borderWidth":"","borderStyle":""})}),
	      $(this).css({"borderColor":"#ff611c","borderWidth":"5px","borderStyle":"solid"},
		  $(this).unbind("mouseout"))
		}
  });
    $(".commends").bind({
       click:function(){
         if($(this).parent().next().next().next().css("display")=="none"){
		    $(this).parent().next().next().next().css("display","block");
			$(this).parent().parent().addClass("commend_onclick");
		   }
	     else if($(this).parent().next().next().next().css("display")=="block"){
	        $(this).parent().next().next().next().css("display","none");
			$(this).parent().parent().removeClass("commend_onclick");
		   }
	   }
    });  
});


