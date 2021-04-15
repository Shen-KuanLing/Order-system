
<?php
require("./db_connect.php");
$sql="select * from dbo.customer";
$qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());

?>
<!DOCTYPE html
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="style.css" rel="stylesheet" type="text/css" />
  <title>列出所有顧客資料</title>
  </head>
  <body style="padding:80px 400px;">
  <table width="700" border="1" style="padding:20px 20px; color:black;">
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
      <td><div style="padding:2px 2px;"><button style="background-color:#7d5a5a;color:white; font-weight:bold; width:50px;height:30px;border:2px blue none;" onclick="location.href='edit_cust.php?key=<?php echo $rs[0]?>'">修改</button></div></td>
    </tr>
  <?php
  }
?>
  </table>
<br/><br/>
<div style="padding-left:300px;">
<button style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:80px;height:40px;border:2px blue none;" onclick="location.href='HOME.html'">回首頁</button>
</div>
<p>&nbsp;</p>
</body>
</html>