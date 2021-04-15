
<?php
require("./db_connect.php");
if($_GET['type']=='order_total') {
  $sql_oc="select * from dbo.order_content";
  $sql_oi="select * from dbo.order_info";
  $qury_oc=sqlsrv_query($conn,$sql_oc) or die("sql error".sqlsrv_errors());
  $qury_oi=sqlsrv_query($conn,$sql_oi) or die("sql error".sqlsrv_errors());
}
else if($_GET['type'] == 'customer_total') {
  $sql="select * from dbo.customer";
  $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
}
if(isset($sql)) {
?>
  <!DOCTYPE html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="style.css" rel="stylesheet" type="text/css" />
  <title>列出所有顧客資料</title>
  </head>
  <body style="padding:80px 400px;">
  <table width="700" border="1" style="padding:20px 20px; color:black">
    <tr style="font-weight:bold;">
      <td>訂購人</td>
      <td>電話</td>
      <td>機關名稱</td>
    </tr>
  <?php
  while($rs=sqlsrv_fetch_array($qury)){
  ?>
    <tr>
      <td><?php echo $rs[0]?></td>
      <td><?php echo $rs[1]?></td>
      <td><?php echo $rs[2]?></td>
    </tr>
  <?php
  }
?>
  </table>
<?php
}
else if(isset($sql_oc)) {
?>
  <!DOCTYPE html
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="style.css" rel="stylesheet" type="text/css" />
  <title>列出所有訂單資料</title>
  </head>
  <body>
  <table width="700" border="1">
    <tr>
      <td>項號</td>
      <td>產品編號</td>
      <td>數量</td>
      <td>小計</td>
      <td>備註</td>
    </tr>
  <?php
  while($rs=sqlsrv_fetch_array($qury_oc)){
  ?>
    <tr>
      <td><?php echo $rs[1]?></td>
      <td><?php echo $rs[2]?></td>
      <td><?php echo $rs[3]?></td>
      <td><?php echo $rs[4]?></td>
      <td><?php echo $rs[5]?></td>
    </tr>
  <?php
  }
?>
  </table>
<?php
}
?>
<br/><br/>
<div style="padding-left:300px;">
<button style="background-color:#7d5a5a;color:white; font-weight:bold; border-radius:13px; width:80px;height:40px;border:2px blue none;" onclick="location.href='HOME.html'">回首頁</button>
</div>
<p>&nbsp;</p>
</body>
</html>