<?php
header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>客服專區</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
	<div id="header">
        <h1>客服專區</h1>
	</div>
	<div id="contents">
		<?php   
		require("./db_connect.php");
		//處理名稱重複部分:
		$name=$_POST['name'];
		$subsql="SELECT 商品名稱 from dbo.product where 商品名稱 = '$name'";
		$subqury=sqlsrv_query($conn,$subsql);
		$row = sqlsrv_fetch_array($subqury);
		if($row) {
			echo "已登錄過此商品!";
			exit();
		}
		
		//資料未輸入完整:
		if(empty($_POST['name'])||empty($_POST['price'])||empty($_POST['product_id'])){
			echo "商品資料輸入不完整。";
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
            if(isset($_POST['product_id'])){
                echo '<font size=3>以下是您輸入的商品資料:<br/><br/>';
				echo '產品編號:';
				echo '<font color=#66B3FF>'.$_POST['product_id'].'</font>';
				echo '<br/>';
			}
			if(isset($_POST['name'])){
				echo '商品名稱:';
				echo '<font color=#66B3FF>'.$_POST['name'].'</font>';
				echo '<br/>';
			}

			if(isset($_POST['price'])){
				echo '單價:';
				echo '<font color=#66B3FF>'.$_POST['price'].'</font>';
				echo '<br/>';
			}
			require("./db_connect.php");
			$name=$_POST['name'];
            $price=$_POST['price'];
            $product_index = $_POST['product_id'];
			$sql="INSERT INTO dbo.product(產品編號, 商品名稱, 單價) VALUES('$product_index','$name','$price')";
			$qury=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
			?>
			</br>
			<input type="button" value="確認" onclick="location.href='./product.html'">	 
		</p>
		</div>
	</div>
</body></html>