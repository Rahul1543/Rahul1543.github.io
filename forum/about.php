<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - Code-Discuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <div class="container my-5">
        <h1>About Code-Discuss</h1>
        <p class="lead">Welcome to Code-Discuss, a peer-to-peer forum designed to bring together developers, programmers, and tech enthusiasts from all around the world.</p>
        
        <h2>Our Mission</h2>
        <p>Our mission is to provide a platform where users can share knowledge, solve problems, and engage in meaningful discussions about various topics in the world of technology.</p>
        
        <h2>What We Offer</h2>
        <ul>
            <li><b>Categories:</b> Organized sections for different programming languages, frameworks, tools, and general tech topics.</li>
            <li><b>Discussions:</b> Start or join conversations on a wide range of technical subjects.</li>
            <li><b>Support:</b> Get help from the community for coding problems, bugs, and technical issues.</li>
            <li><b>Resources:</b> Share and discover tutorials, articles, and other learning materials.</li>
        </ul>
        
        <h2>Community Guidelines</h2>
        <p>To ensure a respectful and productive environment, we ask all members to adhere to the following guidelines:</p>
        <ul>
            <li>Respect the views of other participants.</li>
            <li>Be constructive and keep discussions civil.</li>
            <li>Stay on topic and avoid trolling or bullying.</li>
            <li>Report any inappropriate behavior to the moderators.</li>
        </ul>
        
        <h2>Join Us</h2>
        <p>We invite you to join our community, share your expertise, and learn from others. Whether you are a beginner or an experienced developer, Code-Discuss has something for everyone. <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a> today and become part of our growing community.</p>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
