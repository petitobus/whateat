<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VoucherTrade列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="6">订单列表
            <td>
				<a href="alipay_trade.shtml?page=<?php echo ($last_page); ?>">
                    <input type="button" value="上一页" style="background-color: orange">
                </a>
				<span><?php echo ($current_page); ?>/<?php echo ($max_page); ?></span>
		        <a href="alipay_trade.shtml?page=<?php echo ($next_page); ?>">
				<input type="button" value="下一页" style="background-color: orange">
                </a>
			</td>
			<td>
			    <a href="search.shtml">
				<input type="button" value="查找" style="background-color: orange">
                </a>
			</td>
		</th>
        <tr>
            <td>订单号</td>
            <td>操作员邮箱</td>
            <td>交易金额</td>
            <td>订单时间</td>
            <td>交易内容</td>
            <td>结算汇率</td>
            <td>买家账号</td>
            <td>订单状态</td>
            <td>支付方式</td>
        </tr>
		<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($trade["partner_trans_id"]); ?></td>
			<td><?php echo ($trade["trader_email"]); ?></td>
			<td><?php echo ($trade["trans_amount"]); ?></td>
			<td><?php echo ($trade["trans_create_time"]); ?></td>
			<td><?php echo ($trade["subject"]); ?></td>
			<td><?php echo ($trade["exchange_rate"]); ?></td>
			<td><?php echo ($trade["alipay_buyer_login_id"]); ?></td>
			<td><?php if(($trade['state']) == "0"): ?>新订单<?php endif; ?>
				<?php if(($trade['state']) == "1"): ?>银行未确认<?php endif; ?>
				<?php if(($trade['state']) == "2"): ?>成功<?php endif; ?>
				<?php if(($trade['state']) == "3"): ?>失败<?php endif; ?>
				<?php if(($trade['state']) == "4"): ?>处理中<?php endif; ?>
				<?php if(($trade['state']) == "-1"): ?>已退款<?php endif; ?>
			</td>
			<td><?php if(($trade['method']) == "1"): ?>商家扫码<?php endif; ?>
				<?php if(($trade['method']) == "2"): ?>客户扫码<?php endif; ?>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>