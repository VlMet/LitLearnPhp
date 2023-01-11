<?php include_once "includes/header.php"; ?>
<?php include_once "includes/connect.php"; ?>

<div class="main">
    <h3>Узнать расписание</h3>
    <form method="POST" class="form_selectGroup">
        <select name="group" id="group">

            <?php
            $sql = "SELECT * FROM `groups`";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row["id"] . "'";
                    if (isset($_SESSION["group"])) {
                        if ($_SESSION["group"] == $row["id"]) {
                            echo "selected";
                        }
                    }

                    echo ">" . $row["name"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </select>

        <button type="submit" name="get_ras">Найти</button>
    </form>
</div>

<?php include_once "get_ras.php"; ?>



<style>
    .reload_btn {
        display: none;
    }
</style>
<?php include_once "includes/footer.php"; ?>