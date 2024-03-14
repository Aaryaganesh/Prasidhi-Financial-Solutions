
<?php
session_start();
$email=$_POST['email'];
$password=$_POST['password'];

$con =new mysqli('localhost','sql_admin','Sql@dmin123','test');
if($con->connect_error)
{
    die('connection failed :'.$con->connect_error);
}
else
{
    $stmt = $con->prepare("select * from adminregistration where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result=$stmt->get_result();
    if($stmt_result->num_rows>0)
    {
        $data=$stmt_result->fetch_assoc();
        if($data['password'] == $password)
        {
            header("location: http://localhost:8080/display.php");
        }
        else
        {
            $_SESSION['status']="invalid username or password";
            header("location: http://localhost:8080/adminlogin.php");

        }

    }
    else
    {
        $_SESSION['status']="invalid username or password";
        header("location: http://localhost:8080/adminlogin.php");
        
    }
}
?>

