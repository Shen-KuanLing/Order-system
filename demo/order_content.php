<?php
header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>建立訂單內容</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
	<div id="header">
        <h1>建立訂單內容</h1>
	</div>
	<div id="contents">
		<?php   
		require("./db_connect.php");
		
		//資料未輸入完整:
		if(empty($_POST['order_id'])||empty($_POST['no'])||empty($_POST['product_id'])||empty($_POST['number'])){
			echo "訂單內容輸入不完整。";
			exit();
		}
		/*else{
			echo '輸入成功。<br/>';
		}*/
		?>
	<div class="detail_box clearfix">
		<p class="photo">
        <img src="thanku.jpg" width="250" align ="right" height="200" alt="謝謝你">
    	</p>
    	<p class="text">
            <?php
            //處理未建立訂單部分
		    $orderid=$_POST['order_id'];
		    $subsql="SELECT 訂單編號 from dbo.order_info where 訂單編號 = '$orderid'";
		    $subqury=sqlsrv_query($conn,$subsql);
		    $row = sqlsrv_fetch_array($subqury);
		    if(!$row) {
                echo "<script>alert('訂單尚未建立，請先建立訂單編號才能輸入訂單內容喔!'); location.href = 'order_content.html';</script>";
			    //exit();
		    }
            if(isset($_POST['order_id'])){
                echo '<font size=3>以下是您建立的訂單內容:<br/><br/>';
				echo '訂單編號:';
				echo '<font color=#66B3FF>'.$_POST['order_id'].'</font>';
				echo '<br/>';
			}
			if(isset($_POST['no'])){
                echo '項號:';
				echo '<font color=#66B3FF>'.$_POST['no'].'</font>';
				echo '<br/>';
			}
			if(isset($_POST['product_id'])){
				echo '產品編號:';
				echo '<font color=#66B3FF>'.$_POST['product_id'].'</font>';
				echo '<br/>';
            }
            if(isset($_POST['number'])){
				echo '數量:';
				echo '<font color=#66B3FF>'.$_POST['number'].'</font>';
                echo '<br/>';
                $productid=$_POST['product_id'];
                $subsql = "SELECT 單價 from dbo.product where 產品編號 = '$productid'";
                $subqury=sqlsrv_query($conn,$subsql)or die("sql error".sqlsrv_errors());
                $row = sqlsrv_fetch_array($subqury);
                $subtotal = $row['單價']*$_POST['number'];
                echo '小計:';
                echo '<font color=#66B3FF>'.$subtotal.'</font>';
                echo '<br/>';
            }
            if(isset($_POST['note'])){
				echo '備註:';
				echo '<font color=#66B3FF>'.$_POST['note'].'</font>';
				echo '<br/>';
            }
            /*if(isset($_POST['ship'])){
				echo '送貨方式:';
				echo '<font color=#66B3FF>'.$_POST['ship'].'</font>';
				echo '<br/>';
			}*/
			require("./db_connect.php");
			$orderid=$_POST['order_id'];
            $no=$_POST['no'];
            $productid=$_POST['product_id'];
            $number=$_POST['number'];
            $note=$_POST['note'];
            $subsql = "SELECT 單價 from dbo.product where 產品編號 = '$productid'";
            $subqury=sqlsrv_query($conn,$subsql)or die("sql error".sqlsrv_errors());
			$row = sqlsrv_fetch_array($subqury);
			if(!$row) {
				echo "並沒有此產品編號，請先建立!<br/>";
			}
			else {
				$subtotal = $row['單價']*$number;
				$sql="INSERT INTO dbo.order_content(訂單編號, 項號, 產品編號, 數量, 小計, 備註) VALUES('$orderid','$no','$productid','$number','$subtotal','$note')";
				$qury=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
			
			}
            ?>
			</br>
			<input type="button" value="確認" style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:60px;height:40px;border:2px blue none;" onclick="location.href='./order_content.html'">
			<!--&nbsp&nbsp&nbsp&nbsp
			<input type="button" value="建立此訂單之細項" onclick="location.href='./order_content.html'">	 -->
		</p>
		</div>
	</div>
</body></html>