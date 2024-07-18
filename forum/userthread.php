<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>code-Discuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>

    <?php include 'partials/_header.php';?>
    <?php 
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE `t_id` = $id";
    $res=$conn->query($sql);
    while($row=mysqli_fetch_assoc($res)){
        $title=$row['t_title'];
        $desc=$row['t_desc'];
        $t_user_id=$row['t_user_id'];
        $sql2="SELECT * FROM `users` WHERE `sno` = '$t_user_id'";
        $res2=$conn->query($sql2);
        $row2=mysqli_fetch_assoc($res2);
    }
    ?>

    <div class="container my-2">

        <div class="media my-4">
            <img src="img/userpic.jpg" width="40vmin" class="mr-3" alt="...">
            <div class="media-body">
                <h2 class="mt-0"><?php echo $title;?></h2>
                <p><?php echo $desc;?></p>
                <p><b>Posted by: <?php echo $row2['user_email'];?></b></p>
            </div>
        </div>

        <h4>Post a comment</h4>
        <div class="media">

        <?php 
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<img src="img/userpic.jpg" width="40vmin" class="mr-3" alt="...">
            <div class="media-body">
                <p>
                    <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        +Comment here
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="user_com"
                                    name="user_com"></textarea>
                                <label for="floatingTextarea">Comment</label>
                                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                            </div>
                            <button type="submit" class="btn btn-success my-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>';
        }
        else{
            echo '<img src="img/userpic.jpg" width="40vmin" class="mr-3" alt="...">
            <div class="media-body">
                <p>
                    <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        +Comment here
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <b><i>Please do <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"> login</a> to comment on post</i></b>
                    </div>
                </div>
            </div>';
        }

    ?>

            
        </div>
        <?php
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            if (!empty($_POST['user_com'])) {
                $usercomm = $_POST['user_com'];
                // Sanitize input
                $usercomm = $conn->real_escape_string($usercomm);
                $commby=$_POST['sno'];
                // Insert the thread into the database
                $sql = "INSERT INTO `comment` (`com_desc`, `thread_id`, `com_time`, `com_by`) VALUES ('$usercomm', '$id', current_timestamp(), '$commby');";
                $res = $conn->query($sql);

                if ($res) {
                    echo '<div class="alert alert-success" role="alert">comment has been added successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Failed to add comment. Error: ' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">comment is required.</div>';
            }
        }


        ?>
        <div class="container mb-5" style=min-height:20rem;>
            <h4>Comments</h4>
            <?php 
    $id=$_GET['threadid'];
    $nores=true;
    $sql="SELECT * FROM `comment` WHERE `thread_id` = $id";
    $res=$conn->query($sql);
    while($row=mysqli_fetch_assoc($res)){
        $nores=false;
        $comid=$row['comment_id'];
        $comby=$row['com_by'];
        $comdesc=$row['com_desc'];
        $sql2="SELECT * FROM `users` WHERE `sno` = '$comby'";
        $res2=$conn->query($sql2);
        $row2=mysqli_fetch_assoc($res2);
    

        echo '<div class="media my-3">
            <img src="img/userpic.jpg" width="40vmin" class="mr-3" alt="...">
            <div class="media-body">
                <h6>Posted by: '.$row2['user_email'].'</h6>
                <p>'.$comdesc.'</p>
            </div>
        </div>';

    }
    if ($nores) {
        echo '<div class="alert alert-warning" role="alert">No comments found in this category.</div>';
    }

    
    ?>
        </div>
    </div>


    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


</body>

</html>