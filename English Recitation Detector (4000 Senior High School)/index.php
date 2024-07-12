<?php
//作品：英语单词检测
//作者：沃效乐
//时间：2024年7月12日
$con = mysqli_connect("localhost", "user_name", "user_password");
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, "database");

$state = $_GET['state'];
$english = $_GET['english'];
mysqli_query($con, "UPDATE words SET state = '$state' WHERE english LIKE '$english';");

$sql = "SELECT COUNT(english) AS weiwancheng FROM words Where state = '0'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $weiwancheng = $row["weiwancheng"];
    }
} else {
    $weiwancheng = '错误';
}
$sql = "SELECT COUNT(english) AS tongguo FROM words Where state = '1'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tongguo = $row["tongguo"];
    }
} else {
    $tongguo = '错误';
}
$sql = "SELECT COUNT(english) AS shibai FROM words Where state = '2'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $shibai = $row["shibai"];
    }
} else {
    $shibai = '错误';
}

$result = mysqli_query($con, "SELECT * FROM words WHERE state LIKE '0' ORDER BY RAND() LIMIT 1");
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$english = $row['english'];
	$chinese = $row['chinese'];
} else {
	$english = '已结束';
	$chinese = '感谢您的使用，更多资源请到767733534（第四世界不正经群聊）';
}
?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>英语单词检测</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<style>
		    body {
		        background-color: lightgreen;
		    }
		    .head {
		        background-color: green;
		        font-size: 30px;
		        text-align: center;
		    }
		    .center {
		        text-align: center;
		    }
		    .bottom {
		        display: flex;
		        justify-content: center;
		        align-items: flex-end;
		        width: 100%;
		        position: fixed;
		        bottom: 0;
		        left: 0;
		    }
		    .bottom .item {
		        background-color: green;
		        text-align: center;
		        font-size: 40px;
		        margin: 50px;
		    }
		    a {
		        color: black;
		        text-decoration: none;
		    }
		</style>
	</head>
	<body>
		<div class="head">
			高中英语单词4000普查
		</div>
		<div>
			<div>
			    未完成：<?php echo $weiwancheng;?></a>
			</div>
			<div>
			    通过：<?php echo $tongguo;?></a>
			</div>
			<div>
			    失败：<?php echo $shibai;?></a>
			</div>
		</div>
		<div>
			<div class="center" style="margin: 10px;margin-bottom: 100px;margin-top: 50px;">
				<div style="margin-bottom: 50px;font-size: 60px;">
					<?php echo $english;?>
				</div>
				<div style="display: none;" id="show1">
					<a style="font-size: 30px;"><?php echo $chinese;?></a>
				</div>
			</div>
		</div>
		<div>
			<div class="bottom" id="hidden">
				<div class="item" onclick="document.getElementById('show1').style='display: visible;';document.getElementById('show2').style='display: visible;';document.getElementById('hidden').style='display: none;';">
					显示
				</div>
			</div>
			<div class="bottom" style="display: none;" id="show2">
				<div class="item">
					<a href="index.php?project=<?php echo $project;?>&state=1&english=<?php echo $english;?>">通过</a>
				</div>
				<div class="item">
					<a href="index.php?project=<?php echo $project;?>&state=2&english=<?php echo $english;?>">失败</a>
				</div>
			</div>
		</div>
	</body>
</html>