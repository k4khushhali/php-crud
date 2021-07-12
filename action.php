<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>

    <?php

    // $data = ;

    // $manage = htmlspecialchars('fsjhdfkjhsdkjf''''');

    // print_r($manage);
    // var_dump($manage);

    include 'config.php';

    // initialize variables
    $sname = "";
    $saddress = "";
    $sclass = "";
    $sphone = "";

    // Insert(Add) data
    if (isset($_POST['save'])) {
        $stuname = $_POST['sname'];
        $stuaddress = $_POST['saddress'];
        $stuclass = $_POST['class'];
        $stuphone = $_POST['sphone'];

        // Prevent SQL PHP injection
        $stuname = stripcslashes($stuname);
        $stuaddress = stripcslashes($stuaddress);
        $stuclass = stripcslashes($stuclass);
        $stuphone = stripcslashes($stuphone);
        $stuname = mysqli_real_escape_string($conn, $stuname);
        $stuaddress = mysqli_real_escape_string($conn, $stuaddress);
        $stuclass = mysqli_real_escape_string($conn, $stuclass);
        $stuphone = mysqli_real_escape_string($conn, $stuphone);

        $sql = "INSERT INTO `student`(`sname`, `saddress`, `sclass`, `sphone`) VALUES ('{$stuname}','{$stuaddress}','{$stuclass}','{$stuphone}')";
        mysqli_query($conn, $sql) or die("Query unsuccessfull !");

        header("Location: http://localhost:8080/php-crud/index.php");
    }

    // Fetch data for edit
    if (isset($_GET['edit'])) {
        $stu_id = $_GET['edit'];
        $update = true;
        echo $update;
        $record = mysqli_query($conn, "SELECT * FROM student WHERE sid = {$stu_id}");
        // print_r($record);
        if ($record->num_rows == 1) {
            $row = mysqli_fetch_array($record);
            // print_r($row);
            $sid = $row['sid'];
            $sname = $row['sname'];
            $saddress = $row['saddress'];
            $sclass = $row['sclass'];
            $sphone = $row['sphone'];
        }
    }

    // Update(Edit) data
    if (isset($_POST['update'])) {
        $stuid = $_POST['sid'];
        $stuname = $_POST['sname'];
        $stuaddress = $_POST['saddress'];
        $stuclass = $_POST['sclass'];
        $stuphone = $_POST['sphone'];

        // Prevent SQL PHP injection
        $stuname = stripcslashes($stuname);
        $stuaddress = stripcslashes($stuaddress);
        $stuclass = stripcslashes($stuclass);
        $stuphone = stripcslashes($stuphone);
        $stuname = mysqli_real_escape_string($conn, $stuname);
        $stuaddress = mysqli_real_escape_string($conn, $stuaddress);
        $stuclass = mysqli_real_escape_string($conn, $stuclass);
        $stuphone = mysqli_real_escape_string($conn, $stuphone);

        $sql = "UPDATE `student` SET `sname`='{$stuname}',`saddress`='{$stuaddress}',`sclass`='{$stuclass}',`sphone`='{$stuphone}' WHERE `sid` = {$stuid}";
        $result = mysqli_query($conn, $sql) or die("Query unsuccessfull !");

        header("Location: http://localhost:8080/php-crud/index.php");
    }
    ?>

    <form class="post-form" action="action.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
            <input type="text" name="sname" value="<?php echo $sname; ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $saddress; ?>" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <?php
            $sql1 = "SELECT * FROM studentclass";

            $result1 = mysqli_query($conn, $sql1) or die("Query unsuccessfull !");

            // print_r(mysqli_fetch_assoc($result1));
            if (isset($_GET['edit'])) {
                if (mysqli_num_rows($result1) > 0) {
                    echo '<select name="sclass">';

                    while ($row1 = mysqli_fetch_assoc($result1)) {

                        if ($row['sclass'] == $row1['cid']) {
                            $select = "selected";
                        } else {
                            $select = "";
                        }
                        echo "<option $select value='{$row1['cid']}'>{$row1['cname']}</option>";
                    }
                    echo "</select>";
                }
            } else {
            ?>
                <select name="class">
                    <option value="" selected disabled>Select Class</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result1)) {
                    ?>
                        <option value="<?php echo $row['cid']; ?>"><?php echo $row['cname']; ?></option>
                    <?php }
                    mysqli_close($conn);
                    ?>
                </select>
            <?php } ?>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $sphone; ?>" />
        </div>

        <?php if (isset($_GET['edit'])) : ?>
            <button type="submit" name="update">update</button>
        <?php else : ?>
            <button type="submit" name="save">Save</button>
        <?php endif ?>

    </form>

</div>
</div>
</body>

</html>