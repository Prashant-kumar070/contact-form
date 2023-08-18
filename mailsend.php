<?php
session_start();


//connecting database 

$_hostname="localhost";
$_username="root";
$_password="";
$db_name="test";

$conn= mysqli_connect($_hostname,$_username,$_password,$db_name);
if(!$conn){
    echo "<script>alert('Not connected with Server ,try again')</script>";
    return;
}


//checking if we get data from previous page ..
if(isset($_GET)){
    $name=$_GET['name'];
    $phone=$_GET['mobileno'];
    $email=$_GET['email'];
    $subject=$_GET['subject'];
    $message=$_GET['message'];


//ip address
    $ip=$_SERVER['REMOTE_ADDR'];

    $sql=" INSERT INTO `contact_form` (`name`, `phone`, `email`, `subject`, `message`, `ip`) VALUES ('$name', '$phone', '$email', '$subject', '$message', '$ip')";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo"<script>alert('something went Wrong')</script>";
        echo "<script>window.location.href ='index.php'</script>";
   
    }


 //sending mail 
 $to="prashantkumarpkw12345@gmail.com";
 $headers="From: '.$email.'";
 if(mail($to,$subject,$message,$header)){
   
    echo"<script>alert('Message Sent succesfully ".$name."')</script>";
    echo "<script>window.location.href ='index.php'</script>";
  
 }
 else{
     echo"<script>alert('Something went Wrong , Try Again ".$name."')</script>";
     echo "<script>window.location.href ='index.php'</script>";

 }
}
?>