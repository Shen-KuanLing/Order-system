<?php
header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>新增顧客</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
	<div id="header">
        <h1>新增顧客資料</h1>
	</div>
	<div id="contents">
		<?php   
		require("./db_connect.php");
		/*if(!isset($_POST['name'])||!isset($_POST['phone'])||!isset($_POST['email'])){
			echo "進來惹1</br>";
			if(!isset($_POST['name'])){
				echo "姓名格式輸入錯誤<br/>";
			}
			$name=$_POST['name'];
			$subsql="SELECT 訂購人 from dbo.customer where 訂購人 = '$name'";
			$subqury=sqlsrv_query($conn,$subsql);
			$row = sqlsrv_fetch_array($subqury);
			echo $row;
			if($row) {
				echo "名稱重複!";
			}
			else{
				echo"";
			}
			if(!isset($_POST['phone'])){
				echo "電話格式輸入錯誤<br/>";
			}
			else{
				echo"";
			}
			if(!isset($_POST['email'])){
				echo "機關名稱輸入錯誤<br/>";
				echo $_POST['email'];
			}
			else{
				echo"";
			}
		}*/
		//處理名稱重複部分:
		$name=$_POST['name'];
		$subsql="SELECT 訂購人 from dbo.customer where 訂購人 = '$name'";
		$subqury=sqlsrv_query($conn,$subsql);
		$row = sqlsrv_fetch_array($subqury);
		//echo $row['訂購人'];
		if($row) {
			echo "名稱與其他顧客名稱重複，請取別的名字!";
			exit();
		}
		
		//資料未輸入完整:
		if(empty($_POST['name'])||empty($_POST['phone'])||empty($_POST['email'])){
			echo "您有資料未輸入。";
			exit();
		}
		else{
			if(isset($_POST['name'])){
				echo '<h2>'.$_POST['name'].' 的顧客資料新增成功囉!<br/></h2>';
				echo '<br/>';
			}
		}
		?>
	<div class="detail_box clearfix">
		<p class="photo">
        <img src="thanku.jpg" width="250" align ="right" height="200" alt="謝謝你">
    	</p>
    	<p class="text">
			<?php
			if(isset($_POST['phone'])){
				echo '<font size=3>以下是您輸入的資料:<br/><br/>';
				echo '電話:';
				echo '<font color=#66B3FF>'.$_POST['phone'].'</font>';
				echo '<br/>';
			}
			else{
				echo "電話格式輸入錯誤</br>";
			}

			if(isset($_POST['email'])){
				echo '機關名稱:';
				echo '<font color=#66B3FF>'.$_POST['email'].'</font>';
				echo '<br/>';
			}
			else{
				echo "機關名稱輸入錯誤</br>";
			}
					
			//$serverName="LAPTOP-P832HNAS\SQLEXPRESS";
			//$connectionInfo=array("Database"=>"TEST","UID"=>"sklfad_db","PWD"=>"22597318","CharacterSet"=>"UTF-8");
			//$conn=sqlsrv_connect($serverName,$connectionInfo);
			require("./db_connect.php");
			$name=$_POST['name'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$sql="INSERT INTO dbo.customer(訂購人,電話,機關名稱) VALUES('$name','$phone','$email')";
			$qury=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
			?>
			</br>
			<input type="button" value="確認" onclick="location.href='./HOME.html'">	 
		</p>
		</div>
	</div>
</body></html>