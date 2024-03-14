<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
		function redirect(status) {
			if (status == 'success') {
				window.location.href = 'reallogin.php?status=success';
			}
        }
</script>
</head>
<style>
    .go_back{
        width:100px;
    height: 40px;
    cursor:pointer;
    padding: 0 5px;
    margin:30px auto;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>
<body>
<div class="button">
    <button class="go_back" onclick="redirect('success')">Go back to Login Page</button>
</div>
<?php
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $conn = new mysqli('localhost','root','','test');
    if($conn->connect_error){
        die('connection failed :'.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(name,email,password,number)values(?,?,?,?)");
        $stmt->bind_param("sssi",$name,$email,$password,$number);
        $stmt->execute();
        echo "Registration successfull";
        
        $stmt->close();
        $conn->close();

    }
?>
</body>
</html>
