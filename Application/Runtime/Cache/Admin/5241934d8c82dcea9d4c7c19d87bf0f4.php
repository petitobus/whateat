<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加菜谱</title>
</head>
<body>
<div>
  <h1>添加菜谱</h1>
  <div id="principal_area">
    <div>
      <h2>菜谱名称</h2>
      <input type="text" required="required" name="name" placeholder="new dish">
    </div>
    <div>
      <h2>描述</h2>
      <textarea name="description">好吃</textarea>
    </div>
    <div id="steps">
      <h2>步骤</h2>
      <ul id="step_list">
		<li>
          <h3>步骤1</h3>
		  <textarea class="step" name="step" value="1">chaotant</textarea>
		</li>
      </ul>
      <button id="add_step" style="display: block;margin: 0 auto 0">new step</button>
    </div>
  </div>
  <div id="supplement_area">
    <div id="ingredients">
      <h2>食材</h2>
	  <ul id="ingredient_list">
	  </ul>
      <button id="add_ingredient" style="display: block;margin: 0 auto 0">new ingredient</button>
    </div>
    <div id="flavours">
      <h2>调料</h2>
        <ul id="flavour_list">
        </ul>
      <button id="add_flavour" style="display: block;margin: 0 auto 0">new flavour</button>
    </div>
  </div>
    <div>
    <br>
      <button id="submit" style="display: block;margin: 0 auto 0">ok</button>
    </div>
        
</div>
</body>
</html>

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    var step_num=1;
    var ingredient_num=0;
	var flavour_num=0;
	
    $(function() {
        $("#submit").on("click", function() {
		    var dish_name=$("input[name=name]").val();
			var description=$("textarea[name=description]").val();
			var i=0;
			var steps = [];
			$('#step_list').find('li').map(function() {
				var step={};
				step.sort = i;
				step.content = $(this).children('textarea').val();
				i++;
				steps.push(step);
			});
			var ingredients = [];
			i=0;
			$('#ingredient_list').find('li').map(function() {
				var ingredient={};
				ingredient.id = this.value;
				ingredient.quantity = $(this).children('.ingredient_quantity').text();
				ingredient.level = $(this).children('.ingredient_level').text();
				i++;
				ingredients.push(ingredient);
			});
			var flavours = [];
			i=0;
			$('#flavour_list').find('li').map(function() {
				var flavour={};
				flavour.id = this.value;
				flavour.quantity = $(this).children('.flavour_quantity').text();
				flavour.level = $(this).children('.flavour_level').text();
				i++;
				flavours.push(flavour);
			});

			var json=JSON.stringify({
				name:dish_name,
				description:description,
				steps:steps,
				flavours:flavours,
				ingredients:ingredients
				});
			alert(json);
			
			var aj = $.ajax( {    
				url:"<?php echo U('Dish/create');?>",// 跳转到 action    
				data:{
					json:JSON.stringify({
						json: json
					}) 
				},    
				type:'post',    
				cache:false,    
				dataType:'json',    
				success:function($data) {    
					if($data.status =='1' ){    					
						window.location.href=$data.url;    
					}else{    
						alert($data.info);   
					}    
				},    
				error : function() {    
					alert("error");    
				}    
			}); 
        });
    });
    $(function(){
        $("#add_step").on("click", function() {
			var step_current=$('textarea[name=step][value='+step_num+']').val();
			if(step_current==""){
				alert("当前步骤空");
			}
			else{
				step_num++;
				var step_title=document.createElement("h3");
				var texto=document.createTextNode("步骤"+step_num);
				step_title.appendChild(texto);
				var para=document.createElement("textarea");
				para.setAttribute("class","step");
				para.setAttribute("name","step");
				para.setAttribute("value",step_num);
				
				var step=document.createElement("li");
				step.appendChild(step_title);
				step.appendChild(para);
				var element=document.getElementById("step_list");
				element.appendChild(step);
			}
        });
    });
    $(function(){
        $("#add_ingredient").on("click", function() {
          alert("这里应该弹出选择食材的窗口");
          ingredient_num++;
          var ingredient=document.createElement("li");
	      ingredient.setAttribute("value","1");
          var name=document.createElement("span");
          name.setAttribute("class","ingredient_name");
          name.setAttribute("value",ingredient_num);
          var text1=document.createTextNode("土豆");
          name.appendChild(text1);
          ingredient.appendChild(name);

          var quantity=document.createElement("span");
          quantity.setAttribute("class","ingredient_quantity");
          quantity.setAttribute("value",ingredient_num);
          text2=document.createTextNode("300g");
          quantity.appendChild(text2);
          ingredient.appendChild(quantity);
		  
          var level=document.createElement("span");
          level.setAttribute("class","ingredient_level");
          level.setAttribute("value",ingredient_num);
          text3=document.createTextNode("1");
          level.appendChild(text3);
          ingredient.appendChild(level);
		  
		  var list=document.getElementById("ingredient_list");
          list.appendChild(ingredient);
        });
		$("#add_flavour").on("click", function() {
          alert("这里应该弹出选择调料的窗口");
          flavour_num++;
          var flavour=document.createElement("li");
		  flavour.setAttribute("value","1");


          var name=document.createElement("span");
          name.setAttribute("class","flavour_name");
          name.setAttribute("value",flavour_num);
          var text1=document.createTextNode("酱油");
          name.appendChild(text1);
          flavour.appendChild(name);

          var quantity=document.createElement("span");
          quantity.setAttribute("class","flavour_quantity");
          quantity.setAttribute("value",flavour_num);
          text2=document.createTextNode("一丢丢");
          quantity.appendChild(text2);
          flavour.appendChild(quantity);
		  
          var level=document.createElement("span");
          level.setAttribute("class","flavour_level");
          level.setAttribute("value",flavour_num);
          text3=document.createTextNode("0");
          level.appendChild(text3);
          flavour.appendChild(level);
		  
		  var list=document.getElementById("flavour_list");
          list.appendChild(flavour);
        });
    });
</script>