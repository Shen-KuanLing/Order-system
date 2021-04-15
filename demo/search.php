<?php
header("Content-Type:text/html; charset=utf-8");


?>
<html>
<?php
header("Content-Type:text/html; charset=utf-8");


?>
<!-- saved from url=(0076)http://mepopedia.com/~web102-a/midterm/hw03_1015445024/graphic%20design.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>查詢顧客資料</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
         <h1>查詢顧客資料</h1>
  </div>
    
<div id="contents">
<?php   		
		require("./db_connect.php");
		if($_POST['name'] != '') {
			$name = $_POST['name'];
			$sql="SELECT 訂購人, 電話, 機關名稱 from dbo.customer where 訂購人 = '$name'";
			$subqury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());;
			$row = sqlsrv_fetch_array($subqury);
			if(!$row) {
				echo "查無此人!</br ></br>";
			}
			else {
				//echo $row['訂購人'].",".$row['電話'].",".$row['機關名稱']."<br/><br />";
				echo "訂購人: ".$row['訂購人'];
				echo "<br/>電話: ".$row['電話'];
				echo "<br/>機關名稱: ".$row['機關名稱'];
				echo "<br/><br/>";
			}
		}
		else {
			echo "請輸入所欲查詢的顧客名稱。</br ></br>";
			//$sql="select * from dbo.customer";
		}
?>
<input type="button" style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:80px;height:40px;border:2px blue none;" value="回搜尋頁" onclick="location.href='./search.html'">
</div>


</body></html>


