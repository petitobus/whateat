<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script src="/westylegit/code/Application/Common/Common/static/js/jquery.qrcode.min.js"></script>
    <title>code</title>
</head>
<body>
<div id="code" style="text-align:center;margin-top:30px;"></div>
<script>
$('#code').qrcode('<?php echo ($voucher["voucher_code"]); ?>');
</script>
</body>