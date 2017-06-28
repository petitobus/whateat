<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加菜谱</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="4">添加菜谱</th>
        <tr>
            <td>菜谱名称</td>
            <td><input type="text" required="required" id="name" placeholder="new city"></td>
        </tr>
        <tr>
            <td>描述</td>
            <td><input type="text" required="required" id="country" placeholder="new country"></td>
        </tr>
        <tr>
            <td>步骤一</td>
            <td><input type="text" required="required" id="step_1" placeholder="new country"></td>
        </tr>
        <tr>
            <td>步骤二</td>
            <td><input type="text" required="required" id="step_2" placeholder="new country"></td>
        </tr>
        <tr>
            <td>食材一</td>
            <td><input type="text" required="required" id="ingredient_1_name" placeholder="new country"></td>
            <td><input type="text" required="required" id="ingredient_1_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" id="ingredient_1_level" placeholder="new country"></td>
        </tr>        <tr>
            <td>食材二</td>
            <td><input type="text" required="required" id="ingredient_2_name" placeholder="new country"></td>
            <td><input type="text" required="required" id="ingredient_2_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" id="ingredient_2_level" placeholder="new country"></td>
        </tr>
         <tr>
            <td>调料一</td>
            <td><input type="text" required="required" id="flavour_1_name" placeholder="new country"></td>
            <td><input type="text" required="required" id="flavour_1_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" id="flavour_1_level" placeholder="new country"></td>
        </tr>
        <tr>
            <td>食材2</td>
            <td><input type="text" required="required" id="flavour_2_name" placeholder="new country"></td>
            <td><input type="text" required="required" id="flavour_2_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" id="flavour_2_level" placeholder="new country"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</div>
</body>
</html>