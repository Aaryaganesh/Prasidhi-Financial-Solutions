<?php
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Addressproof = $_POST['Addressproof'];
    $KYC_Compliant = $_POST['KYC_Compliant'];
    $AddressLine1 = $_POST['AddressLine1'];
    $AddressLine2 = $_POST['AddressLine2'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];
    $SourceType = $_POST['SourceType'];
    $Service = $_POST['Service1'].",".$_POST['Service2'].",".$_POST['Service3'];
    //$uploadaddressproof=$_POST['uploadaddressproof'];
    //$uploadPanCard=$_POST['uploadPanCard'];
    

    $conn = new mysqli('localhost','root','','test');
    if($conn->connect_error){
        die('connection failed :'.$conn->connect_error);
    }else{
       // try{
        $stmt = $conn->prepare("insert into mainregistration(Firstname,Lastname,Email,Phone,Addressproof,KYC_Compliant,AddressLine1,AddressLine2,City,State,Service,ZipCode,SourceType)values(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssisssssssss",$Firstname,$Lastname,$Email,$Phone,$Addressproof,$KYC_Compliant,$AddressLine1,$AddressLine2,$City,$State,$Service,$ZipCode,$SourceType);
        $stmt->execute();
        $id = $conn->insert_id;
       // echo "Application submitted successfully";
        $stmt->close();
        $conn->close();
        upload("uploadaddressproof",$id);
        upload("uploadPanCard",$id);
        header("Location:invoice.php?id=".$id);
       //echo  "file ".$_POST["uploadaddressproof"];
       
 

  
  


      /* // }
       // catch(Exception $e)
       // {
           // echo "message: ".$e->getMessage();
      //  }*/

    }
    function upload($proof,$id){
         

      if(isset($_FILES["$proof"])){
       mkdir("uploads/".$id);
       $errors= array();
       $file_name = $_FILES["$proof"]['name'];
       $file_size =$_FILES["$proof"]['size'];
       $file_tmp =$_FILES["$proof"]['tmp_name'];
       $file_type=$_FILES["$proof"]['type'];
       $file_ext=strtolower(end(explode('.',$_FILES["$proof"]['name'])));
       
       $extensions= array("pdf","doc","docx","png","jpg","jpeg");
       
       if(in_array($file_ext,$extensions)=== false){
          $errors[]="extension not allowed, please choose a JPEG or PNG file.";
       }
       
       if($file_size > 2097152){
          $errors[]='File size must be exactly 2 MB';
       }
       
       if(empty($errors)==true){
          move_uploaded_file($file_tmp,"uploads/".$id."/".$file_name);
          echo "Success";
          
       }else{
          echo "errors";
       }
    }
    else{echo "not executed";}
    $conn = new mysqli('localhost','root','','test');
    $file_path = '~/uploads'.$id."/".$file_name;
    $sql = "UPDATE mainregistration SET ".$proof ."='". $file_path."' WHERE id =". $id;
    $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  }


?>