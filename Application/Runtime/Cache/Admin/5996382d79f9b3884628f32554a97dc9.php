<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VoucherTrade列表</title>
</head>
<body>
<div>
    <table border="1">
	    <form action="/westylegit/code/index.php/Admin/VoucherTrade/search.shtml" method="post">
			<th colspan="5">查找Voucher交易
				<td>
					<input type="hidden" value="submitted" name="action">
					<input type="submit" value="查找" style="background-color: orange">
				</td>
			</th>
			<tr>
				<td>voucher名</td>
				<td>详细单号</td>
				<td>操作员邮箱</td>
				<td>交易金额</td>
				<td>单笔提成</td>
				<td>起始日期</td>
				<td>终止日期</td>
			</tr>
			<tr>
				<td><input type="text" name="voucher_name" placeholder="无要求请留空"></td>
				<td><input type="text" name="voucher_detail" placeholder="无要求请留空"></td>
				<td><input type="email" name="trader_email" placeholder="无要求请留空"></td>
				<td><input type="text" name="trans_amount" placeholder="无要求请留空"></td>
				<td></td>
				<td><input type="date" name="trans_create_time_begin" placeholder="无要求请留空"></td>
				<td><input type="date" name="trans_create_time_end" placeholder="无要求请留空"></td>
			</tr>
		</form>
		
		<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($trade["voucher_name"]); ?></td>
			<td><?php echo ($trade["voucher_detail"]); ?></td>
			<td><?php echo ($trade["trader_email"]); ?></td>
			<td><?php echo ($trade["trans_amount"]); ?></td>
			<td><?php echo ($trade["commision_amount"]); ?></td>
			<td colspan="2"><?php echo ($trade["trans_create_time"]); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>