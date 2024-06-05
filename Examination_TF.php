<?php
session_start();
require_once 'DB_conn.php';

$sql = "SELECT * FROM truefalse ORDER BY RAND() LIMIT 5";
	echo '<h1>是非題</h1>';
	// echo '<p>您的ID是：' . $user_id . '</p>'; 
	echo '<form method="post" action="Examination_S.php">';
	echo '<table border>';
	echo '<tr bgcolor="green" align="center"><td>ID</td><td>問題</td><td>你的答案</td></tr>';
    $questionNumber = 1;
	if ($result = mysqli_query($link, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<tr>';
			echo '<td>' . $questionNumber . '</td>'; // Display the question ID
			echo '<td>' . $row["question"] . '</td>';
			echo '<td>';
			echo '<input type="radio" name="answer' . $row["id"] . '" value="Y"> True ';
			echo '<input type="radio" name="answer' . $row["id"] . '" value="N"> False';
			echo '</td>';
			echo '</tr>';
            $questionNumber++;
		}
	}
	echo '</table></br>';
	echo '<input type="submit" value="前往選擇題">';
	echo '</form>';

	mysqli_free_result($result);
	mysqli_close($link);
?>
