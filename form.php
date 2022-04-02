<?php 
require_once './connect.php';

if (isset($_POST['submit']) && $_POST['submit'] == 'add') {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age   = (int) $_POST['age'];

    $sql = "INSERT INTO student (fname, lname, age) VALUES ('$fname', '$lname', $age)" ;

    if($conn->query($sql) === TRUE) {
        $msg = "data added successfully";
    } else {
        $msg = "soory a problem happend";
    }

}

if (isset($_POST['del']) && $_POST['del'] == 'delete') {
    $sql = "DELETE FROM student WHERE id = {$_POST['fordelete']}";
    if($conn->query($sql) === TRUE) {
        $msg = 'row deleted successfuly';
    }

}





if (isset($_POST['ed']) && $_POST['ed'] == 'edit'){
    $edit = true ;
    $sql = "SELECT * FROM student WHERE id = {$_POST['foredit']}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $fnameedit = $row['fname'];
            $lnameedit = $row['lname'];
            $ageedit   = (int) $row['age'];  
        }
    }
    
}

if (isset($_POST['submit']) && $_POST['submit'] == 'edit') {

        $fname = $_POST['fname'];
        $lname  = $_POST['lname'];
        $age   = (int) $_POST['age'];

    $sql = "UPDATE student SET fname='$fname',lname='$lname',age='$age'  WHERE id={$_POST['updateid']}";

    if($conn->query($sql) === TRUE) {
        $msg = "data edited successfully";
    } else {
        $msg = "soory a problem happend" .$conn->error;
    }

}





$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th , td, tr {
            border : solid 1px black;
            border-collapse: collapse;
            padding: 2px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <input type="text" name="fname" placeholder="put your name" value="<?= @$fnameedit ?>" required>
        <input type="text" name="lname" placeholder="put your last name" value="<?= @$lnameedit ?>" required>
        <input type="number" name="age" placeholder="put your age" value="<?= @$ageedit ?>" required>

        <?php 
            if(@$edit){
               echo "<input type='hidden' name='updateid' value='{$_POST['foredit']}' >" ;
               echo "<input type='submit' name='submit' value='edit'>";

            } else {
                echo "<input type='submit' name='submit' value='add'>";
            }
        ?>
    </form>

    <?php
        if (isset($msg)) {
            echo "<p>$msg</p>";
        }
    ?>

    <table>
        <tr>
            <th>id</th>
            <th>first name</th>
            <th>last name</th>
            <th>age</th>
            <th>date</th>
            <th>delet</th>
            <th>edit</th>
        </tr>

        <?php 
            foreach($data as $d) {
                echo "<tr>
                        <td>{$d['id']}</td>
                        <td>{$d['fname']}</td>
                        <td>{$d['lname']}</td>
                        <td>{$d['age']}</td>
                        <td>{$d['reg_date']}</td>
                        
                        <td>
                            <form method='POST'>
                                <input type='submit' value='delete' name='del'>
                                <input type='hidden' value='{$d['id']}' name='fordelete'>
                                
                            </form>
                        </td>

                        <td>
                            <form method='POST'>
                                <input type='submit' value='edit' name='ed'>
                                <input type='hidden' value='{$d['id']}' name='foredit'>
                            </form>
                        </td>
                     </tr>";
            }
        
        ?>
            
    </table>
</body>
</html>