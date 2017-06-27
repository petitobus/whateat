<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>更新商店信息</title>
</head>
<body>
<div>
    <form action="post?method=update&id=<?php echo ($shop["id"]); ?>" method="post">
        <table border="1">
            <th colspan="6">更新商店信息</th>
            <tr>
                <td>商店名称</td>
                <td><input type="text" name="name" placeholder="new name" required="required" value="<?php echo ($shop["name"]); ?>"></td>
            </tr>
            <tr>
                <td>商店地址</td>
                <td><input type="text" name="adr" placeholder="new address" required="required" value="<?php echo ($shop["adr"]); ?>"></td>
            </tr>
            <tr>
                <td>联系电话</td>
                <td><input type="text" name="tel" placeholder="new tel" required="required" value=<?php echo ($shop["tel"]); ?>></td>
            </tr>
            <tr>
                <td>商店传真</td>
                <td><input type="text" name="fax" placeholder="new fax" value=<?php echo ($shop["fax"]); ?>></td>
            </tr>
            <tr>
                <td>商店邮箱</td>
                <td><input type="email" name="email" placeholder="new E-mail" required="required" value=<?php echo ($shop["email"]); ?>></td>
            </tr>
			<tr>
                <td>邮编</td>
                <td><input type="text" name="area" placeholder="new area"  value=<?php echo ($shop["area"]); ?>></td>
            </tr>
            <tr>
                <td>所属城市</td>
                <td>
                    <select name="city">
						<?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><option value="<?php echo ($city["id"]); ?>" 
							<?php if(($shop['city']) == $city['id']): ?>selected<?php endif; ?>
							><?php echo ($city["name"]); ?>,<?php echo ($city["country"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>所属商圈</td>
                <td>
                    <select name="commercial_area_id">
						<?php if(is_array($commercial_area_list)): $i = 0; $__LIST__ = $commercial_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$commercial_area): $mod = ($i % 2 );++$i;?><option value="<?php echo ($commercial_area["id"]); ?>"
							<?php if(($shop['commercial_area_id']) == $commercial_area['id']): ?>selected<?php endif; ?>
							><?php echo ($commercial_area["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
			<tr>
                <td>银行端ID</td>
                <td><input type="text" name="Merchant_ID" placeholder="merchant id"   value=<?php echo ($shop["merchant_id"]); ?>></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         更新         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>