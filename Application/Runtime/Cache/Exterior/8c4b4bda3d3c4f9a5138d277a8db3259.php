<?php if (!defined('THINK_PATH')) exit();?>
<h2>This script a simulation of the Android app. </h2>
<p>The script collects the bar code in your Alipay App then send the request to seraph server. The server transmits the request to klikandpay</p>
<p>please input your bar code</p>
<form action="app_simu.shtml" method="POST">
Bar Code:<br>
<input type="text" name="code">
<br><br>
<input type="submit" name="sendto" value="pay">
<input type="submit" name="sendto" value="Only Alipay">
</form>

<form action="app_simu.shtml" method="POST">
partner_trans_id:<br>
<input type="text" name="code">
<br><br>
<input type="submit" name="sendto" value="Only Bank">
</form>