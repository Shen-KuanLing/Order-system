<?php
header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>新增訂單</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
	<div id="header">
        <h1>新增訂單</h1>
	</div>
	<div id="contents">
		<?php   
		require("./db_connect.php");
		
		//資料未輸入完整:
		if(empty($_POST['order_id'])||empty($_POST['cust'])||empty($_POST['invoice_id'])||empty($_POST['address'])){
			echo "訂單資訊輸入不完整。";
			exit();
		}
		else{
			echo '輸入成功。<br/>';
		}
		?>
	<div class="detail_box clearfix">
		<p class="photo">
        <img src="thanku.jpg" width="250" align ="right" height="200" alt="謝謝你">
    	</p>
    	<p class="text">
            <?php
            if(isset($_POST['order_id'])){
                echo '<font size=3>以下是您建立的訂單資訊:<br/><br/>';
				echo '訂單編號:';
				echo '<font color=#66B3FF>'.$_POST['order_id'].'</font>';
				echo '<br/>';
			}
			if(isset($_POST['cust'])){
				echo '訂購者:';
				echo '<font color=#66B3FF>'.$_POST['cust'].'</font>';
				echo '<br/>';
			}
			if(isset($_POST['invoice_id'])){
				echo '發票編號:';
				echo '<font color=#66B3FF>'.$_POST['invoice_id'].'</font>';
				echo '<br/>';
            }
            if(isset($_POST['address'])){
				echo '送貨地址:';
				echo '<font color=#66B3FF>'.$_POST['address'].'</font>';
				echo '<br/>';
            }
            if(isset($_POST['comment'])){
				echo '客戶留言:';
				echo '<font color=#66B3FF>'.$_POST['comment'].'</font>';
				echo '<br/>';
            }
            if(isset($_POST['payway'])){
				echo '付款方式:';
				echo '<font color=#66B3FF>'.$_POST['payway'].'</font>';
				echo '<br/>';
            }
            /*if(isset($_POST['ship'])){
				echo '送貨方式:';
				echo '<font color=#66B3FF>'.$_POST['ship'].'</font>';
				echo '<br/>';
			}*/
			require("./db_connect.php");
			$orderid=$_POST['order_id'];
            $cust=$_POST['cust'];
            $invoiceid=$_POST['invoice_id'];
            $add=$_POST['address'];
            $comment=$_POST['comment'];
            $payway = $_POST['payway'];
            //$ship = $_POST['ship'];
			$sql="INSERT INTO dbo.order_info(訂單編號, 訂購人, 發票編號, 送貨地址, 客戶留言, 付款方式, 送貨方式) VALUES('$orderid','$cust','$invoiceid','$add','$comment','$payway','a')";
			$qury=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
			?>
			</br>
			<input type="button" value="確認" style="background-color:7d5a5a;color:white; font-weight:bold; border-radius:13px; width:60px;height:40px;border:2px blue none;" onclick="location.href='./order.html'">
			<!--&nbsp&nbsp&nbsp&nbsp
			<input type="button" value="建立此訂單之細項" onclick="location.href='./order_content.html'">	 -->
		</p>
		</div>
	</div>
</body></html>