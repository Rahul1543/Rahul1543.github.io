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

    <?php include 'partials/_header.php';
    ?>
    <?php 
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE `cid` = $id";
    $res=$conn->query($sql);
    while($row=mysqli_fetch_assoc($res)){
        $catname=$row['cname'];
        $catdesc=$row['c_description'];
    }
    ?>

    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        if (!empty($_POST['t_title']) && !empty($_POST['t_desc'])) {
            $th_title = $_POST['t_title'];
            $th_desc = $_POST['t_desc'];
            $th_by=$_SESSION['sno'];
            // Sanitize input
            $th_title = $conn->real_escape_string($th_title);
            $th_desc = $conn->real_escape_string($th_desc);

            // Insert the thread into the database
            $sql = "INSERT INTO `threads` (`t_title`, `t_desc`, `t_cat_id`, `t_user_id`, `timedate`) VALUES ('$th_title', '$th_desc', '$id', '$th_by', current_timestamp())";
            $res = $conn->query($sql);

            if ($res) {
                echo '<div class="alert alert-success" role="alert">Thread has been added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to add thread. Error: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Title and Description are required.</div>';
        }
    }


    ?>

    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?></h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a perr to perr forum Always respect the views of other participants.Be constructive.Always keep
                things civil.Once you've left your comment keep an eye on the forum to see what other people have to
                say.If you feel that someone has insulted you please do report. Stay on topic. These forums have been
                created for a specific purpose..Don't be a “troll.”.Don't bully, harass or threaten other participants.
            </p>
            <a href="#" class="btn btn-success btn-lg" role="button">Learn more</a>
        </div>
    </div>
    <div class="container mb-5" style=min-height:20rem;>
    <?php 
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<p>
                    <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        +Start a new conversation
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Discussion Title</label>
                                <input type="text" class="form-control" id="t_title" name="t_title" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Discussion/problem title</div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a description here" id="t_desc" name="t_desc"></textarea>
                                <label for="floatingTextarea">Description</label>
                            </div>
                            <button type="submit" class="btn btn-success my-3">Submit</button>
                        </form>
                    </div>
                </div>';
        }
        else{
            echo '<p>
                    <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        +Start a new conversation
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <b><i>Please do <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"> login</a> to start a conversation</i></b>
                    </div>
                </div>';
        }

    ?>
    
        
        

        <h4>Browse Discussions</h4>
        <?php 
    $id=$_GET['catid'];
    $nores=true;
    $sql="SELECT * FROM `threads` WHERE `t_cat_id` = $id";
    $res=$conn->query($sql);
    while($row=mysqli_fetch_assoc($res)){
        $nores=false;
        $tid=$row['t_id'];
        $title=$row['t_title'];
        $desc=$row['t_desc'];
        $t_user_id=$row['t_user_id'];
        $sql2="SELECT * FROM `users` WHERE `sno` = '$t_user_id'";
        $res2=$conn->query($sql2);
        $row2=mysqli_fetch_assoc($res2);
    

        echo '<div class="media my-3">
            <img src="img/userpic.jpg" width="40vmin" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a href="userthread.php?threadid='.$tid.'">'.$title.'</a></h5>
                <p>'.$desc.'</p>
                <p my-0 mx-0><b><i>Posted By: '.$row2['user_email'].' at '.$row['timedate'].'</i></b></p>
            </div>
        </div>';

    }
    if ($nores) {
        echo '<div class="alert alert-warning" role="alert">No threads found in this category.</div>';
    }

    
    ?>
    </div>


    <?php include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


</body>

</html>