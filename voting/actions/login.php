<?php
session_start();//inorder to use the session variables 
include('connect.php');
$username=$_POST['username'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$std=$_POST['std'];

$sql="Select * from userdata where username='$username' and mobile='$mobile' and password='$password' and standard='$std'";
$result=mysqli_query($con,$sql);//executing query
if(mysqli_num_rows($result)>0)
{
    $sql="Select username,photo,votes,id from userdata where standard='group'";
    $resultgroup=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $groups=mysqli_fetch_all($resultgroup,MYSQLI_ASSOC);
        //THIS MYSQLI_ASSOC IS GOING TO CREATE AN OBJECT WHICH GROUPS ALL THE GROUPS IN THE DATABASE
        $_SESSION['groups']=$groups;//created a session variable and stored the fetched groups inorder to pass this data to other page

    }
    $data=mysqli_fetch_array($result);//FETCHING USER RECORD
    $_SESSION['id']=$data['id'];
    $_SESSION['status']=$data['status'];
    $_SESSION['data']=$data;
    echo '<script>
    window.location="../partials/dashboard.php";
 </script>';
}
else{
    echo '<script>
    alert("Invalid credentials");
    window.location="../";
 </script>';
}
?>
