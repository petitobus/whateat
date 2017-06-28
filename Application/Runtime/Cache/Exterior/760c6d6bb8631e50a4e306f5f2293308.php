<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>data to refund</title>
</head>
<body>
<div>
    <form action="https://www.klikandpay.com/paiement/cancel_transaction.pl" method="get">
        <table border="1">
            <th colspan="4">Test to Refund</th>
            <tr>
                <td>ID</td>
                <td><input type="text" required="required" name="ID" value = <?php echo ($data["ID"]); ?>></td>
            </tr>            <tr>
                <td>TX</td>
                <td><input type="text" required="required" name="TX"  value = <?php echo ($data["TX"]); ?>></td>
            </tr>            <tr>
                <td>MONTANT</td>
                <td><input type="text" required="required" name="MONTANT"  value = <?php echo ($data["MONTANT"]); ?>></td>
            </tr>            <tr>
                <td>PRIVATE_KEY</td>
                <td><input type="text" required="required" name="PRIVATE_KEY"  value = <?php echo ($data["PRIVATE_KEY"]); ?>></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="valide" style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>