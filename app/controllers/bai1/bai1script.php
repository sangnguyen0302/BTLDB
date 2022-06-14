
<?php
session_start();
require_once "../../DB.php";
$con = mysqli_connect("localhost","root","","driver_service");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

    
if(isset($_GET['view-db'])){
        $_SESSION['view-db']="view_db active";
        header("Location: ../../views/bai1.php");
        exit();
}
if(isset($_GET['logout'])){
    unset($_GET['user_id']);
    session_destroy();
    header("Location: ../../views/bai1.php");
    exit();
}
else {
    $_SESSION['view-db']="view_db";
}
if(isset($_GET['add-record'])){
    header("Location: ../../views/bai1.php?add-record=1");
    exit();
}
//Check ssn
if(isset($_GET['check-ssn-submit'])){
    $ssn = $_GET['check-ssn'];
    //Kiểm tra có ssn này chưa--------------------------------------------------->
    $sql = "SELECT * FROM Person WHERE SSN='$ssn' ";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        header("Location: ../../views/bai1.php?add-record=".$ssn);
    }else {
        header("Location: ../../views/bai1.php?insert-person=1");
    }

}
// Thêm person --------------------------------------------------->--------------------------------------------------->
if(isset($_GET['add_person_confirm'])){
    $ssn= $_GET['add-ps-ssn'];
    $fname= $_GET['add-ps-fname'];
    $lname = $_GET['add-ps-lname'];
    $gender = $_GET['add-ps-gender'];
    //Sửa lại ở đây --------------------------------------------------->--------------------------------------------------->
    $sql = " INSERT INTO person VALUES('$id','$atype','$un','$pw','$ssn')";
        if ($con->query($sql)) {
            echo "New record created successfully";
        }else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
      } 
    header("Location: ../../views/bai1.php?add-record".$snn);
}
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    header("Location: ../../views/bai1.php?edit-record='$id'");
    exit();
}
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
        // sửa lại hàm ở đây......///
        $sql = " DELETE FROM account WHERE ID=$id";
        if ($con->query($sql)) {
            echo "New record deletedd successfully";
        }else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
      } 
      header("Location: ../../views/bai1.php");
      
}

// Thêm 1 tài khoản
if(isset($_GET['add_confirm']))
{
    $id= $_GET['add-id'];
    $atype= $_GET['add-atype'];
    $un = $_GET['add-uname'];
    $pw = $_GET['add-pass'];
    $ssn = $_GET['add-ssn'];
        if(empty($id)) {
        array_push($errors,  "required"); 
        }
        if (empty($atype)) {
        array_push($errors, "required"); 
        }
        if(empty($un)) {
        array_push($errors, "required"); 
        }
        if(empty($pw)) {
            array_push($errors, "required"); 
        }
        if(empty($ssn)) {
            array_push($errors, "required"); 
        }
        // sửa lại hàm ở đây......///
        $sql = " INSERT INTO ACCOUNT VALUES('$id','$atype','$un','$pw','$ssn')";
        if ($con->query($sql)) {
            echo "New record created successfully";
        }else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
      } 
      header("Location: ../../views/bai1.php");
}
//Thay đổi thông tin
if(isset($_GET['change_confirm']))
{
    $old_pass =$_GET['old-pass'];
    $un = $_GET['user-name'];
    $new_pw = $_GET['change-pass'];
        // sửa lại hàm ở đây......///
        $sql = " UPDATE account SET ID='$id', UserName='$un', ATYPE='$atype', PASS='$pw', SSN='$ssn' WHERE ID=$old_id ";
        if ($con->query($sql)) {
            echo "The record change successfully";
        }else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
      } 
      header("Location: ../../views/bai1.php");
}
?>