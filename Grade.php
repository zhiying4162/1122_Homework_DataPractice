<?php
	session_start();
	$user_id = $_SESSION['id'];
	
	require_once 'DB_conn.php';

	$truefalseScore = 0;
	$selectionScore = 0;

	// 是非題
	$sqlTruefalse = "SELECT id, answer FROM truefalse";
	if ($resultTruefalse = mysqli_query($link, $sqlTruefalse)) {
		while ($rowTruefalse = mysqli_fetch_assoc($resultTruefalse)) {
			$questionId = $rowTruefalse["id"];
			$correctAnswer = $rowTruefalse["answer"];
			if (isset($_POST["answer$questionId"])) {
				$studentAnswer = $_POST["answer$questionId"];
				if ($studentAnswer == $correctAnswer) {
					$truefalseScore += 2; 
				}
			}
		}
		mysqli_free_result($resultTruefalse);
	} 

	// 選擇題
	$sqlSelection = "SELECT id, answer FROM selection";
	if ($resultSelection = mysqli_query($link, $sqlSelection)) {
		while ($rowSelection = mysqli_fetch_assoc($resultSelection)) {
			$questionId = $rowSelection["id"];
			$correctAnswer = $rowSelection["answer"];
			
			if (isset($_POST["answer$questionId"])) {
				$studentAnswer = $_POST["answer$questionId"];
				
				$answerArray = str_split($correctAnswer);
				$studentIndex = ord($studentAnswer) - ord('A');  
				
				if (isset($answerArray[$studentIndex]) && $answerArray[$studentIndex] == 'Y') {
					$selectionScore += 2; 
				}
			}
		}
		mysqli_free_result($resultSelection);
	} 

	$grade = $truefalseScore + $selectionScore;
	date_default_timezone_set('Asia/Taipei');
	$testDate = date('Y-m-d H:i:s');

	if (isset($grade)) {
		$insertSql = "INSERT INTO grade (testDate, id, grade) VALUES ('$testDate', '$user_id', '$grade')";
		if (mysqli_query($link, $insertSql)) {
			echo "成績已成功寫入資料庫";
		} else {
			echo "寫入時出錯" . mysqli_error($link);
		}
	}

	mysqli_close($link);
?>

<h1>測驗成績</h1>
<p>ID：<?php echo $user_id; ?></p>
<p>是非題得分：<?php echo $truefalseScore; ?> 分</p>
<p>選擇題得分：<?php echo $selectionScore; ?> 分</p>
<hr>
<p>總分：<?php echo $grade ?> 分</p>


<a href="Login.html">登出</a>