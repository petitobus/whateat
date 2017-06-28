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
                <td>返利等级</td>
                <td><input type="text" name="level" placeholder="new level" required="required" value=<?php echo ($shop["level"]); ?>></td>
            </tr>
            <tr>
                <td>商店描述</td>
                <td><textarea name="description" placeholder="new description" required="required"> <?php echo ($shop["description"]); ?></textarea></td>
            </tr>
            <tr>
                <td>商店内容</td>
                <td><textarea name="content" placeholder="new content" required="required"><?php echo ($shop["content"]); ?></textarea></td>
            </tr>
            <tr>
                <td>商店标签</td>
                <td><input type="text" name="tag" placeholder="请用逗号分隔" value=<?php echo ($shop["tag"]); ?>></td>
            </tr>
            <tr>
                <td>商店链接</td>
                <td><input type="url" name="link" placeholder="new link" value=<?php echo ($shop["link"]); ?>></td>
            </tr>
            <tr>
                <td>商店排序</td>
                <td><input type="text" name="sort" placeholder="new sort" required="required" value=<?php echo ($shop["sort"]); ?>></td>
            </tr>
            <tr>
                <td>营业时间</td>
                <td><input type="text" name="open_time" placeholder="new horaire" required="required" value=<?php echo ($shop["open_time"]); ?>></td>
            </tr>
            <tr>
                <td>退税率</td>
                <td><input type="text" name="tax_return" placeholder="new tax return" required="required" value=<?php echo ($shop["tax_return"]); ?>></td>
            </tr>
			<tr>
                <td colspan="2"><input type="submit" value="         添加/更新         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>