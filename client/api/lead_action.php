<?php
//leads post

include("./config.php");
session_start();

if(isset($_POST['submitt'])){
    $Firm_Name=$_POST['Fname'];
    $Client_Name=$_POST['Cname'];
    $Mobile_Number=$_POST['number'];
    $Requirement=$_POST['requirement'];
   
    $sql=mysqli_query($conn,"INSERT INTO `lead`(`Firm_Name`,`Client_Name`, `Mobile_Number`,`Requirement`) VALUES ('$Firm_Name','$Client_Name','$Mobile_Number','$Requirement')");

    if($sql==1){
        echo '<script>alert("Saved!", "data successfully submitted", "success");</script>';
        header("location:./lead.php");
    }else {
        echo '<script>alert("oops...somthing went wrong");</script>';
    }
}
?>