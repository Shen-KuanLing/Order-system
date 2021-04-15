<?php
header("Content-Type:text/html; charset=utf-8");


?>
<html>
<?php
header("Content-Type:text/html; charset=utf-8");


?>
<!-- saved from url=(0076)http://mepopedia.com/~web102-a/midterm/hw03_1015445024/graphic%20design.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>查詢</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
         <h1>查詢訂單資料</h1>
  </div>
    
<div id="contents">
<?php   		
		require("./db_connect.php");
		if($_POST['name'] != '') {
            $name = $_POST['name'];
            if(isset($_POST['way_1'])) {
                echo "訂單編號: ".$name."<br/><br/>";

                $sql="SELECT 項號, 產品編號, 數量, 小計, 備註 from dbo.order_content where 訂單編號 = '$name' ORDER BY 項號 ASC";
                $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
                echo "項號&nbsp&nbsp&nbsp產品編號&nbsp&nbsp&nbsp商品名稱&nbsp&nbsp&nbsp數量&nbsp&nbsp&nbsp小計&nbsp&nbsp&nbsp備註<br/><hr/>";
                $total_price = 0;

                
                while($row=sqlsrv_fetch_array($qury)){
                    echo $row[0]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                    echo $row[1]."&nbsp&nbsp&nbsp";
                    $product_name_sql = "select 商品名稱 from dbo.product where 產品編號 = '$row[1]'";
                    $pn_qury=sqlsrv_query($conn,$product_name_sql) or die("sql error".sqlsrv_errors());
                    $r=sqlsrv_fetch_array($pn_qury);
                    echo $r['商品名稱']."&nbsp&nbsp&nbsp";
                    echo $row[2]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                    echo $row[3]."&nbsp&nbsp&nbsp";
                    echo $row[4]."&nbsp&nbsp&nbsp<br/>";
                    $total_price += ($row[2]*$row[3]);
                }
                $subsql="SELECT 訂購人, 發票編號, 送貨地址, 客戶留言, 付款方式, 送貨方式 from dbo.order_info where 訂單編號 = '$name'";
                $subqury=sqlsrv_query($conn,$subsql) or die("sql error".sqlsrv_errors());
                $subrow=sqlsrv_fetch_array($subqury);
                echo "<br/>訂購人: ".$subrow[0];
                echo "<br/>發票編號: ".$subrow[1];
                echo "<br/>送貨地址: ".$subrow[2];
                echo "<br/>客戶留言: ".$subrow[3];
                if($subrow[4] == '1') {
                    $pay_way = '貨到付款';
                }
                else if($subrow[4] == '2') {
                    $pay_way = 'ATM轉帳';
                }
                else {
                    $pay_way = '郵政劃撥';
                }
                echo "<br/>付款方式: ".$pay_way;
                echo "<br/>送貨方式: 貨運宅配";
                echo "<br/>合計: ".$total_price;
            }
            if(isset($_POST['way_2'])) {
                echo "訂購者 ".$name."的訂單編號有:<br/><br/>";
                $sql="SELECT 訂單編號 from dbo.order_info where 訂購人 = '$name'";
                $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
                $count = 0;
                while($row=sqlsrv_fetch_array($qury)){
                    $count++;
                    echo $row[0]."<br/>";
                }
                echo "<br/><br/>共".$count."筆。";
            }
        }
        echo "<br/><br/>";
?>
<input type="button" value="回搜尋頁" style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:80px;height:40px;border:2px blue none;" onclick="location.href='./search_order.html'">
</div>


</body></html>