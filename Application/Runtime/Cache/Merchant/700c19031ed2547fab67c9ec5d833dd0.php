<?php if (!defined('THINK_PATH')) exit();?><html>
<frameset rows="40,*">
  <frame name="top_frame" src="<?php echo U('Index/top_menu');?>">
	<frameset cols="200,*">
		<frame name="left_frame" src="<?php echo U('Index/left_menu');?>">
		<frame name="content_frame" src="<?php echo U('Index/home');?>">
	</frameset> 
</frameset> 

<noframes>
<body>您的浏览器无法处理框架！</body>
</noframes>
</html>