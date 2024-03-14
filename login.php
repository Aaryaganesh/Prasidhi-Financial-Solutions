<?php
session_start();
$email=$_POST['email'];
$password=$_POST['password'];

$con=new mysqli("localhost","root","","test");

if($con->connect_error)
{
     die("connection failed :".$con->connect_error);
}
else
{
     
    $stmt = $con->prepare("select * from registration where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result=$stmt->get_result();
    if($stmt_result->num_rows>0)
    {
        $data=$stmt_result->fetch_assoc();
        if($data["password"]==$password)
        {
            /*echo"<h2>login successfully<\h2>";*/
          header('Location:http://localhost:8080/clientchoose.html');
    

        }else{
            $_SESSION['status']="invalid username or password";
            header("location: http://localhost:8080/reallogin.php");
            
       
        }
    }
    else 
    {
        $_SESSION['status']="invalid username or password";
        header("location: http://localhost:8080/reallogin.php");
        
    }   
}
?>
