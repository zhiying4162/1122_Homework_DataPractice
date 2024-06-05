<?php
session_start();
require_once 'DB_conn.php';

echo '<h1>選擇題</h1>';

echo '<form method="post" action="Grade.php">';

foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
}

$sql = "SELECT id, question, selOne, selTwo, selThree, selFour FROM selection ORDER BY RAND() LIMIT 15";
echo '<table border>';
echo '<tr bgcolor="green" align="center"><td>題號</td><td>問題</td><td>你的答案</td></tr>';
$questionNumber = 6;
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $questionNumber . '</td>';
        echo '<td>' . $row["question"] . '</td>';
        echo '<td>';
        echo '<input type="radio" name="answer' . $row["id"] . '" value="A">' . $row["selOne"] . ' ';
        echo '<input type="radio" name="answer' . $row["id"] . '" value="B">' . $row["selTwo"] . ' ';
        echo '<input type="radio" name="answer' . $row["id"] . '" value="C">' . $row["selThree"] . ' ';
        echo '<input type="radio" name="answer' . $row["id"] . '" value="D">' . $row["selFour"] . ' ';
        echo '</td>';
        echo '</tr>';
        $questionNumber++;
    }
}
echo '</table></br>';
echo '<input type="submit" value="送出答案">';
echo '</form>';

mysqli_free_result($result);
mysqli_close($link);
?>