<?php 

  // check get request data
  $id = $_GET['id'];

  // connect to data base and fetch all departments 
  require 'config/db_conn.php';
  
  $sql_statement = "SELECT u.name FROM appuser u WHERE u.user_id='$id'";
  $result = mysqli_query($conn, $sql_statement);
  $rows_array = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // print_r($rows_array);
  $name = $rows_array[0]['name'];

  $sql_statement = "SELECT * FROM department d";
  $result = mysqli_query($conn, $sql_statement);
  $rows_array_deps = mysqli_fetch_all($result, MYSQLI_ASSOC);
?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Login page</title>
    <link rel='stylesheet' type='text/css' href='styles/style.css'>
    <script src="scripts/validation.js"></script>

</head>

<body class="align">

  <div class="table-container">

    <table class="table-fill">
      <div class="table-title">
    <h3><?php echo "Welcom, " . $name; ?> </h3>
      </div>
      <thead>
          <tr>
            <th colspan="1">Department Name</th>
            <th colspan="1">Description</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($rows_array_deps as $department): ?>
          <tr>
            <td><?php echo $department['name']; ?></td>
            <td><?php echo $department['description']; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

 </body> 

</html>