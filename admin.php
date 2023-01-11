<?php include_once "includes/header.php"; ?>
<?php include_once "includes/connect.php"; ?>
<?php
//echo "dasdas " . var_export($_SESSION['admin'], true);;
if (!$_SESSION['admin']) {
        //echo $_SESSION['admin'];
        exit("нет доступа");
    }
?>
<div class="block">
    <form action="" method="post">
        <span>Режим администратора
            <button type="submit" name="exit">Выйти</button>
        </span>
    </form>
</div>
<?php 
    if (isset($_POST['exit'])) {
        $_SESSION['admin'] = false;
        //echo "sad :(";
    }
?>

<div class="publicate block">
    <form action="" method="POST">
        <h3>Выложить расписание на дату:&nbsp;&nbsp;<input type="date" name="date" id="date" value="<?= date("Y-m-") . intval(date("d")) + 1; ?>">
        </h3>
        <table>
            <tr>
                <td>Группа</td>
                <td>1 пара</td>
                <td>2 пара</td>
                <td>3 пара</td>
                <td>4 пара</td>
                <td>5 пара</td>
                <td>6 пара</td>

            </tr>
            <tr>
                <?php
                $sql = "SELECT * FROM `groups`";
                $result = mysqli_query($connect, $sql);

                echo "<td><select name='group'>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<option id='group' value='" . $row["id"] . "'>" . $row["name"] . "</option>";

                        //echo "<td>" . $row["id"] . "<input type='hidden' name='" . $row["id"] . "'></td>";

                    }
                } else {
                    echo "0 results";
                }
                echo "</select></td>";
                for ($i = 1; $i <= 6; $i++) {
                    echo "<td><input value type='text' name='l" . $i . "' id='l" . $i . "'></td>";
                }
                ?>
            </tr>
        </table>
        <div><span>Импорт расписания из txt&nbsp; <a href="files/ras.txt" download>(пример)</a>&nbsp;</span><input type="file" onchange="readFile(this, true)" id="file"></div>

        <div class="form_selectGroup">

            <button id="s" type="submit" name="s">Выложить</button>
        </div>

    </form>
</div>

<?php
if (isset($_POST['s'])) {
    $sql = "INSERT INTO `lessons` (`group_id`, `date`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`) 
    VALUES ('{$_POST['group']}','{$_POST['date']}','{$_POST['l1']}','{$_POST['l2']}','{$_POST['l3']}','{$_POST['l4']}','{$_POST['l5']}','{$_POST['l6']}');";

    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "Запись добавлена";
    }
}
?>
<!------------------------------------------------------->
<div class="publicate block">
    <form action="" method="POST" id="message_form">
        <h3>Опубликовать сообщение&nbsp;&nbsp;<input type="hidden" name="date" id="date" value="<?= date("Y-m-") . intval(date("d")) + 1; ?>">
        </h3>
        <table>
            <tr>
                <td>Группа</td>
                <td>Сообщение</td>
            </tr>
            <tr>
                <?php
                $sql = "SELECT * FROM `groups`";
                $result = mysqli_query($connect, $sql);

                echo "<td><select name='group'>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<option id='group' value='" . $row["id"] . "'>" . $row["name"] . "</option>";

                        //echo "<td>" . $row["id"] . "<input type='hidden' name='" . $row["id"] . "'></td>";

                    }
                } else {
                    echo "0 results";
                }
                echo "</select></td>";
                ?>
                <td id="td_mess"><textarea name="mess" id="mess" form="message_form"></textarea>
                </td>
            </tr>
        </table>
        <div><span>Импорт сообщения из txt&nbsp; <a href="files/mes.txt" download>(пример)</a>&nbsp;</span><input type="file" onchange="readFile(this, false)" id="file"></div>

        <div class="form_selectGroup">

            <button id="s" type="submit" name="s_m">Опубликовать</button>
        </div>

    </form>
</div>

<?php
if (isset($_POST['s_m'])) {
    $sql = "INSERT INTO `message` (`group_id`, `date`, `text`) 
    VALUES ('{$_POST['group']}','{$_POST['date']}','{$_POST['mess']}');";

    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "Запись добавлена";
    }
}
?>





<div class="block">
    <h3>Редактирование групп</h3>
    <div class="edit_groups">

        <div>
            <form method="POST" class="form_selectGroup">
                <select name="group" id="group">

                    <?php
                    $sql = "SELECT * FROM `groups`";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>

                <button type="submit" name="delete_gr">Удалить</button>
            </form>
        </div>
        <div>
            <form action="" method="POST" class="form_selectGroup">
                <input type="text" placeholder="Название" name="name_gr" require>
                <button type="submit" name="create_gr">Добавить</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['delete_gr'])) {
    $sql = "DELETE FROM `groups` WHERE `id` = '{$_POST['group']}'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "успешно - обновите ИС";
    } else {
        echo "ошибка: " . mysqli_error($connect);
    }
}


if (isset($_POST['create_gr'])) {
    $sql = "INSERT INTO `groups` (`name`)
    VALUES ( '{$_POST['name_gr']}')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "успешно  - обновите ИС";
    } else {
        echo "ошибка: " . mysqli_error($connect);
    }
}
?>





<div class="block">
    <h3>Сообщения</h3>

    <table class='table_lessons table_edit' id="tblData">
        <tr>
            <td>Дата</td>
            <td>Группа</td>
            <td>Сообщение</td>
            <td>&nbsp;</td>
        </tr>
        <?php
        //$sql = "SELECT * FROM `lessons` INNER JOIN `groups` ON 'id' = 'group_id'";
        $sql = "SELECT `message`.*, `groups`.`name`
    FROM `groups`
    LEFT JOIN `message` ON `message`.`group_id` = `groups`.`id`
    ORDER BY `date` DESC";

        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["text"] . "</td>";
        ?>
                <td class="delete_l">
                    <form action="" method="POST">
                        <input type="hidden" name="id_mes" value="<?= $row['id'] ?>">
                        <input type="submit" value="Удалить">
                    </form>
                </td>
                </tr>

        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>
</div>


<?php
if (isset($_POST['id_mes'])) {
    $sql = "DELETE FROM `message` WHERE `id` = '{$_POST['id_mes']}'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "Запись удалена";
    } else {
        echo "ошибка";
    }
}


?>







<div class="block">
    <h3>Расписание</h3>

    <table class='table_lessons table_edit' id="tblData">
        <tr>
            <td>Дата</td>
            <td>Группа</td>
            <td>1 пара</td>
            <td>2 пара</td>
            <td>3 пара</td>
            <td>4 пара</td>
            <td>5 пара</td>
            <td>6 пара</td>
            <td>&nbsp;</td>
        </tr>
        <?php
        //$sql = "SELECT * FROM `lessons` INNER JOIN `groups` ON 'id' = 'group_id'";
        $sql = "SELECT `lessons`.*, `groups`.`name`
    FROM `groups`
    LEFT JOIN `lessons` ON `lessons`.`group_id` = `groups`.`id`
    ORDER BY `date` DESC";

        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["l1"] . "</td><td>" . $row["l2"] . "</td><td>" . $row["l3"] . "</td><td>" . $row["l4"] . "</td><td>" . $row["l5"] . "</td><td>" . $row["l6"] . "</td>";
        ?>
                <td class="delete_l">
                    <form action="" method="POST">
                        <input type="hidden" name="id_ras" value="<?= $row['id'] ?>">
                        <input type="submit" value="Удалить">
                    </form>
                </td>
                </tr>

        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>


    <div class="reload_btn">
        <button onclick="exportTableToExcel('tblData','Расписание на ' + new Date().toDateString());">Экспорт текущего расписания в Excel</button>
    </div>
</div>


<?php
if (isset($_POST['id_ras'])) {
    $sql = "DELETE FROM `lessons` WHERE `id` = '{$_POST['id_ras']}'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo "Запись удалена";
    } else {
        echo "ошибка";
    }
}


?>
<!--
</div>
<script src="./js/script.js"></script>
</body>

</html>
-->

<?php include_once "includes/footer.php"; ?>