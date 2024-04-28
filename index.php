<?php
 $conn = mysqli_connect("localhost","root","","todo");
 if($conn){
    echo"Connection Successfull";
 }
 else{
    echo"Connection Failed";
 }

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo App</title>
    <link rel="stylesheet" href="index.css">
 </head>
 <body>
    <h1 id="outerh">ToDo List</h1>
   <div class="container">
      <h1 id="innerh">ToDo List</h1>
       <div class="first"> 
           <table border="1" width="100%">
        <tr>
            
            <th>Task Name</th>
            <th>Task Status</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>
        <tr>
            <?php
            $sql = "select*from todo";
            $res=mysqli_query($conn,$sql);
            while($rs=mysqli_fetch_array($res)){
                ?>
                <td><?php echo $rs['task'];?></td>
                <td><?php echo $rs['status'];?></td>
                <td><?php echo $rs['deadline'];?></td>
                <td><button id="ubtn"><a href="?idu=<?php echo $rs['id'];?>">Update</a></button>
                <button id="dbtn"><a href="?idd=<?php echo $rs['id'];?>">Delete</a></button></td>
                <tr>
                <?php
            }
            ?>
            
        </table>
      </div>
        <div class="formcontainer">
            <h1 id="forminnerh">Add Task</h1>

           <form method="post">
              <label for="task" class="insertl">Task
                <input type="text" name="task" id="inserti">
              </label>
             <label for="status" class="insertl">Status
                <input type="text" name="status" id="inserti">
             </label>
             <label for="deadline" class="insertl">Deadline
                <input type="date" name="deadline" id="inserti">
              </label>
              <input type="submit" value="Add Task" id="formbtn"name="add">
            </form>
        </div>

    </div>

 </body>
 </html>

 <?php
  if(isset($_POST['add'])){
    $task= $_POST['task'];
    $status= $_POST['status'];
    $deadline= $_POST['deadline'];

    $sql="insert into todo(task,status,deadline) values('$task','$status','$deadline')";
    $res=mysqli_query($conn,$sql);
    if($res){
        ?>
        <script>
            alert('Inserted Successfully');
            window.location.href="index.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('Error in insertion');
            // window.location.href="index.php";
        </script>
        <?php

    }
  }

?>

<?php

 if(isset($_GET['idu'])){
    $idu=$_GET['idu'];
    $sql="select*from todo where id=$idu";
    $res=mysqli_query($conn,$sql);
    while($rs= mysqli_fetch_array($res)){
        $idu=$rs['id'];
        $tasku=$rs['task'];
        $statusu=$rs['status'];
        $deadlineu=$rs['deadline'];
    }
    ?>
    <form method="post">
              <label for="task" class="insertu">Id
                <input type="text" name="id" id="insertu"  value="<?php echo $idu;?>">
              </label>
              <label for="task" class="insertu">Task
                <input type="text" name="task" id="insertu"  value="<?php echo $tasku;?>">
              </label>
             <label for="status" class="insertl">Status
                <input type="text" name="status"  value="<?php echo $statusu;?>"id="insertu">
             </label>
             <label for="deadline" class="insertu">Deadline
                <input type="date" name="deadline" id="insertu" value="<?php echo $deadlineu;?>">
              </label>
              <input type="submit" value="Update" id="formbtnu"name="edit">
    </form>
    <?php
 }
 ?>
  <?php
  if(isset($_POST['edit'])){
    $tasku= $_POST['task'];
    $statusu= $_POST['status'];
    $deadlineu= $_POST['deadline'];

    $sql="update todo set task='$tasku',status='$statusu',deadline='$deadlineu' where id=$idu";
    $res=mysqli_query($conn,$sql);
    if($res){
        ?>
        <script>
            alert('Updated Successfully');
            window.location.href="index.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('Error in insertion');
            // window.location.href="index.php";
        </script>
        <?php

    }
  }
  ?>

  <?php 
  if(isset($_GET['idd'])){
    $idd=$_GET['idd'];
    $sql="delete from todo where id= $idd";
    $res=mysqli_query($conn,$sql);
    if($res){
        ?>
        <script>
            alert('Deleted Successfully');
            window.location.href="index.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('Error in insertion');
            // window.location.href="index.php";
        </script>
        <?php

    }



  }
  ?>