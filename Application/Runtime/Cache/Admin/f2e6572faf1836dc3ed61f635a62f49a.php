<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加结点</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="4">添加结点</th>
            <tr>
                <td>controller</td>
                <td><input type="text" name="controller" placeholder="controller"></td>
            </tr>
            <tr>
                <td>method</td>
                <td><input type="text" name="method" placeholder="method"></td>
            </tr>
            <tr>
                <td>name</td>
                <td><input type="text" required="required" name="name" placeholder="name"></td>
            </tr>
            <tr>
                <td>title</td>
                <td><input type="text" required="required" name="title" placeholder="title"></td>
            </tr>
            <tr>
                <td>sort</td>
                <td><input type="num" required="required" name="sort" placeholder="sort"></td>
            </tr>
            <tr>
                <td>pid</td>
				<td>
                    <select name="pid">
						<?php if(is_array($admin_pnode_list)): $i = 0; $__LIST__ = $admin_pnode_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_pnode): $mod = ($i % 2 );++$i;?><option value="<?php echo ($admin_pnode["id"]); ?>"><?php echo ($admin_pnode["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
			<tr>
                <td>level</td>
                <td><input type="num" required="required" name="level" placeholder="0,1,2,3"></td>
            </tr>
            <tr>
                <td>remark</td>
                <td><input type="text" name="remark" placeholder="remark"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>