<?php include_once "includes/connect.php"; ?>

<?php
//$g_id = $_POST["group"];


if (isset($_POST['group'])) {
    $g_id = $_POST['group'];
    $_SESSION["group"] = $g_id;

    $sql = "SELECT * FROM `message` 
    WHERE group_id ='" . $g_id . "'
    ORDER BY `date` DESC";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
?>
        <div class="block">
            <table class='table_lessons'>
                <tr>
                    <td>Дата</td>
                    <td>Сообщение</td>
                </tr>
            <?php
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["date"] . "</td><td>" . $row["text"] . "</td></tr>";
            }
        } else {
            echo "сообщения не найдены";
        }
            ?>
            </table>
        </div>
        <div class="block">
            <table class='table_lessons'>
                <tr>
                    <td>Дата</td>
                    <td>1 пара</td>
                    <td>2 пара</td>
                    <td>3 пара</td>
                    <td>4 пара</td>
                    <td>5 пара</td>
                    <td>6 пара</td>
                </tr>
            <?php
            $sql = "SELECT * FROM `lessons` 
    WHERE group_id ='" . $g_id . "'
    ORDER BY `date` DESC";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["date"] . "</td><td>" . $row["l1"] . "</td><td>" . $row["l2"] . "</td><td>" . $row["l3"] . "</td><td>" . $row["l4"] . "</td><td>" . $row["l5"] . "</td><td>" . $row["l6"] . "</td></tr>";
                }
            } else {
                echo "расписание не найдено";
            }

            echo "</table>";
        }


            ?>
        </div>