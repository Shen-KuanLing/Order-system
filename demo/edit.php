<?php
require("./db_connect.php");
if(isset($_GET['key'])) {
    $product_id = $_GET['key'];
    $sql = "select * from dbo.product where 產品編號 = '$product_id'";
    $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
}
if (isset($_POST['name'])) {
    //echo $_POST['target'];
    //echo $product_id;
    $mod_name = $_POST['name'];
    $edit_sql = "update dbo.product set 商品名稱 = '$mod_name' where 產品編號 = '$product_id'";
    $qury = sqlsrv_query($conn,$edit_sql) or die("sql error".sqlsrv_errors());
    echo "<script>alert('儲存成功'); location.href = 'update_product.php'</script> ";
    exit();
}
if (isset($_POST['price'])) {
    echo $_POST['price'];
    //echo $_POST['target'];
    //echo $product_id;
    $mod_price = $_POST['price'];
    $price_sql = "update dbo.product set 單價 = '$mod_price' where 產品編號 = '$product_id'";
    $qury = sqlsrv_query($conn,$price_sql) or die("sql error".sqlsrv_errors());
    echo "<script>alert('儲存成功'); location.href = 'update_product.php'</script> ";
    exit();
}
?>
<!DOCTYPE html
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>修改商品資料</title>
</head>
<body style="padding:80px 400px;">
<p>

</p>
<table width="700" border="1" style="padding:20px 20px; color:black;">
  <tr style="font-weight:bold;">
    <td>產品編號</td>
    <td>商品名稱</td>
    <td>單價</td>
  </tr>
<?php
while($rs=sqlsrv_fetch_array($qury)){
?>
  <tr>
  <form name="form" action="http://127.0.0.1/demo/edit.php?key=<?php echo $_GET['key']?>" method="POST" accept-charset="UTF-8" align="center">
    <td><?php echo $rs[0]?></td>
    <td><div style="padding:2px 2px;"><input style="background-color:rgb(255,253,237); border: none" type="varchar(15)" name="name" type="text" placeholder="<?php echo $rs[1]?>" />
    <input style="background-color:#7d5a5a;color:white; font-weight:bold; width:50px;height:30px;border:2px blue none;" type="submit" align="right" value="儲存"></div></td>
  </form>
  <form name="form" action="http://127.0.0.1/demo/edit.php?key=<?php echo $_GET['key']?>" method="POST" accept-charset="UTF-8" align="center">
    <td><div style="padding:2px 2px;"><input style="background-color:rgb(255,253,237); border: none" type="varchar(15)" name="price" type="text" placeholder="<?php echo $rs[2]?>" />
    <input style="background-color:#7d5a5a;color:white; font-weight:bold; width:50px;height:30px;border:2px blue none;" type="submit" align="right" value="儲存"></div></td>
  </form>
  </tr>
<?php
}
?>
</table>
<p>&nbsp;</p>
<div style="padding-left:300px;">
<button style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:80px;height:40px;border:2px blue none;" onclick="location.href='HOME.html'">回首頁</button>
</div>
</body>
</html>