<?php
//if errors occur
$errors = "";

//connection to database
$db = mysqli_connect('localhost' , 'root' , '' ,  'todolist');

if(isset($_POST['submit'])) {
    $task = $_POST['task'];
    if (empty($task)){
        $errors = " You must fill in the todoitems";  

    }else {

        mysqli_query($db , "INSERT INTO todoitems (Title) VALUES ('$task')");
header('location: index.php');

    }
}

//delete todoitems
if (isset($_GET['del_task'])) {
    $itemnum = $_GET['del_task'];
    mysqli_query($db , "DELETE FROM todoitems WHERE ItemNum =$itemnum");
    header('location: index.php');
}

$tasks = mysqli_query($db , "SELECT * FROM todoitems");

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>To do list application with PHP and MySQL</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <div class="heading-class"><h2>To do list application with PHP and MySQL</h2>
</div>

<form method = "POST" action= "index.php">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
        <?php } ?>
    
    <input type="text" name= "task" class="task-input">
    <button type ="submit" class="add_btn" name="submit">add task</button>

</form>

<table>
    <thead>
        <tr>
            <th>Item Number</th>
            <th>Description</th>
            <th>Action</th>

        </tr>
    </thead>

    <tbody>
    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="task"><?php echo $row['Title']; ?></td>
            <td class="delete">
                <a href="index.php?del_task=<?php echo $row['ItemNum']; ?>">x</a>
            </td>
        </tr>

        <?php $i++;} ?>
        
    </tbody>
</table>
    </body>
</html>