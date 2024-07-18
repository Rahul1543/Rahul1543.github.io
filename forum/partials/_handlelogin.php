<?php 
$showerror="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $useremail=$_POST['login_email'];
    $userpassword=$_POST['l_password'];

    $exists="SELECT * FROM `users` WHERE `user_email` = '$useremail'";
    $res=$conn->query($exists);
    if($res->num_rows ==1){
        $row = $res->fetch_assoc();
        if(password_verify($userpassword,$row['user_password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$useremail;
            $_SESSION['sno']=$row['sno'];
            header("Location: /forum/index.php?loginstatus=true");
            exit();
        }
        else{
            $showerror="user your password is incorrect";
            header("Location: /forum/index.php?loginstatus=false&error=$showerror");
            exit();
        }
    }
    else{
        $showerror="No account exists please do signup and login";
        header("Location: /forum/index.php?loginstatus=false&error=$showerror");
        exit();

    }

}

?>