<!DOCTYPE html>
<html lang="en">
<head>
  <title>admin only</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Display Table</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Number</th>
        <th>Email</th>
        <th>Password</th>
        

      </tr>
    </thead>
    <tbody>
<?php

$conn =new mysqli('localhost','root','','test');
$sql="select * from registration";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{
   $id = $row['id'];
   echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['name'].'</td>';
    echo '<td>'.$row['number'].'</td>';
    echo '<td>'.$row['email'].'</td>';
    echo '<td>'.$row['password'].'</td>';

    //echo "<td><button type='button' class='btn btn-warning'>edit</button></td>";
    //echo "<td><button type='button' class='btn btn-warning'>delete</button></td>";
    echo '</tr>';
    
}

?>
    </tbody>
  </table>
</div>
</body>
</html>
