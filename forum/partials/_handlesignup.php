<?php 
$showerror="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $useremail=$_POST['signup_email'];
    $userpassword=$_POST['s_password'];
    $user_cpass=$_POST['s_cpassword'];

    $exists="SELECT * FROM `users` WHERE `user_email` = '$useremail'";
    $res=$conn->query($exists);
    if($res->num_rows > 0){
        $showerror="user email already exists";
    }
    else{
        if($userpassword==$user_cpass){
            $hashed_password=password_hash($userpassword,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timedate`) VALUES ('$useremail', '$hashed_password', current_timestamp())";
            $result = $conn->query($sql);
            if($result){
                $alert=true;
                header("Location:/forum/index.php?signupstatus=true");
                exit();
            }
        }
        else{
            $showerror="user your passwords do not match";
            
        }
    }

    header("Location:/forum/index.php?signupstatus=false&error=$showerror");
    exit();
}

?>