<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>code-Discuss</title>
    <style>
    .carousel-img {
        width:100%;
    }

    @media (min-width: 768px) {
        .carousel-img {
            height: 40rem;
        }
    }

    @media (min-width: 1200px) {
        .carousel-img {
            height: 600px;
        }
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>

    <?php include 'partials/_header.php';?>
    <div id="carouselExampleIndicators" class="carousel slide ">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img id="carousel-img-1" class="d-block w=100" alt="..." style="max-height: 70vh;width:100%">
            </div>
            <div class="carousel-item">
                <img id="carousel-img-2" class="d-block w-100" alt="..." style="max-height: 70vh;">
            </div>
            <div class="carousel-item">
                <img id="carousel-img-3" class="d-block w-100" alt="..." style="max-height: 70vh;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container my-2">
        <h4 class="text-center">Categories</h4>
        <div class="row">
            <?php foreach ($categories as $category): ?>
            <div class="col-md-4">
                <div class="card my-3" style="width: 18rem;">
                    <img id="card-img-<?php echo $category['cid']; ?>" class="card-img-top" alt="..."
                        style="width: 18rem; height: 12rem;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threads.php?catid=<?php echo $category['cid']; ?>"><?php echo htmlspecialchars($category['cname']); ?></a></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($category['c_description'],0,120)).'...'; ?></p>
                        <a href="threads.php?catid=<?php echo $category['cid'];?>" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    async function fetchImage(text, elementId) {
        console.log(`Fetching image for: ${text}, elementId: ${elementId}`);
        try {
            const res = await fetch(
                `https://api.unsplash.com/search/photos?query=${text}&client_id=PipMCntSiy1j6-J9UQ0toV2yWtnFJqcnbUU5NQU1CBE`
                );
            if (res.ok) {
                const data = await res.json();
                const image = data.results[0]?.urls?.regular;
                if (image) {
                    document.getElementById(elementId).src = image;
                }
            } else {
                console.error('Error fetching image');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    <?php foreach ($categories as $category): ?>
    fetchImage('<?php echo addslashes($category['cname']); ?>', 'card-img-<?php echo $category['cid']; ?>');

    <?php endforeach; ?>
    const carouselKeywords = ['people with laptop', 'software company', 'people talking'];
    carouselKeywords.forEach((keyword, index) => {
        fetchImage(keyword, `carousel-img-${index + 1}`);
    });
    </script>
</body>

</html>