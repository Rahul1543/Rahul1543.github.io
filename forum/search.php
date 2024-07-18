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
    <?php include 'partials/_dbconnect.php'; ?>

    <?php include 'partials/_header.php'; ?>


    <div class="container my-3" style=min-height:85vh>
        <h5 class="py-3">Search results for <b><i><?php echo htmlspecialchars($_GET['search']); ?></i></b></h5>

        <?php
        $query = htmlspecialchars($_GET['search']);
        $sql = "SELECT * FROM `threads` WHERE match (t_title,t_desc) against ('$query')";
        $res = $conn->query($sql);
        $nores = true;
        while ($row = mysqli_fetch_assoc($res)) {
            $nores = false;
            $tid = $row['t_id'];
            $title = $row['t_title'];
            $desc = $row['t_desc'];
            $t_user_id = $row['t_user_id'];
            $sql2 = "SELECT * FROM `users` WHERE `sno` = '$t_user_id'";
            $res2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($res2);

            echo '<div class="d-flex align-items-start my-3">
                <img src="img/userpic.jpg" width="40" class="me-3" alt="...">
                <div>
                    <h5 class="mt-0"><a href="userthread.php?threadid=' . $tid . '">' . htmlspecialchars($title) . '</a></h5>
                    <p>' . htmlspecialchars($desc) . '</p>
                    <p class="my-0 mx-0"><b><i>Posted By: ' . htmlspecialchars($row2['user_email']) . ' at ' . $row['timedate'] . '</i></b></p>
                </div>
            </div>';
        }
        if ($nores) {
            echo '<div class="alert alert-warning" role="alert">No threads found for this search word. Please make sure to search a correct keyword.</div>';
        }
        ?>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
