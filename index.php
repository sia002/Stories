<?php
require "settings/init.php";

$sql = "SELECT * FROM books";
$result = $db->sql($sql);
?>

<!DOCTYPE html>
<html lang="da">
<?php include("includes/header.php"); ?>


<body>
<?php include("includes/navbar.php"); ?>

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h1 class="my-5 text-dark">Top 3 <i class="fa-solid fa-star" style="color: #d8b266;"></i> <i class="fa-solid fa-star" style="color: #d8b266;"></i> <i class="fa-solid fa-star" style="color: #d8b266;"></i></h1>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row justify-content-center d-flex align-items-stretch">
        <?php
        if (!empty($result)) {
            foreach ($result as $row) {
                $description_lines = explode("\n", $row->description);
                $first_line = htmlspecialchars($description_lines[0]);

                echo '<div class="col-4 col-md-3 col-lg-3 mb-4">
                    <a href="review.php?id=' . htmlspecialchars($row->id) . '" class="card-link" style="text-decoration: none; color: inherit;">
                        <div class="card text-center h-100">
                            <img src="' . htmlspecialchars($row->image) . '" class="card-img-top" alt="Book Image">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row->title) . '</h5>
                                <p class="card-text">' . $first_line . '</p>
                                <p class="card-text">Bedømmelse: ' . htmlspecialchars($row->rating) . ' / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                            <span class="btn bg-primary">Læs mere om bogen</span>
                            </div>
                        </div>
                    </a>
                </div>';
            }
        } else {
            echo "<p>Ingen bøger fundet.</p>";
        }
        ?>
    </div>
</div>


<br>
<br>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h3 class="my-5 text-info">Populære skønlitteratur bøger</h3>
        </div>
    </div>
</div>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM skon_books ORDER BY rating DESC LIMIT 8";
        $result = $db->sql($sql);

        if (empty($result)) {
            echo "<p>Ingen bøger blev fundet.</p>";
        } else {
            $active = 'active';
            $cardCount = 0;

            echo '<div class="carousel-item ' . $active . '"><div class="d-flex justify-content-center flex-wrap">';

            foreach ($result as $row) {
                echo '<a href="review_skon.php?id=' . htmlspecialchars($row->id) . '" class="card-link">
                            <div class="card mx-1 mb-4" style="width: 18rem;">
                                <img src="' . htmlspecialchars($row->image_url) . '" class="card-img-top" alt="' . htmlspecialchars($row->title) . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row->title) . '</h5>
<p class="card-text">' . htmlspecialchars(explode('.', $row->description)[0]) . '.</p>
                                    <p class="card-text">Bedømmelse: ' . htmlspecialchars($row->rating) . ' / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                                    <span class="btn btn-primary">Læs mere om bogen</span>
                                </div>
                            </div>
                          </a>';
                $cardCount++;

                if ($cardCount % 4 === 0 && $cardCount < count($result)) {
                    echo '</div></div>';
                    echo '<div class="carousel-item"><div class="d-flex justify-content-center flex-wrap">';
                }
            }

            echo '</div></div>';
        }
        ?>
    </div>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            <a href="skon.php" class="btn btn-secondary">Se alle skønlitteratur bøger</a>
        </div>
    </div>
</div>



<br>
<br>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h3 class="my-5 text-info">Populære krimibøger</h3>
        </div>
    </div>
</div>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM krimi_books ORDER BY rating DESC LIMIT 8";
        $result = $db->sql($sql);

        if (empty($result)) {
            echo "<p>Ingen bøger blev fundet.</p>";
        } else {
            $active = 'active';
            $cardCount = 0;

            echo '<div class="carousel-item ' . $active . '"><div class="d-flex justify-content-center flex-wrap">';

            foreach ($result as $row) {
                echo '<a href="review_krimi.php?id=' . htmlspecialchars($row->id) . '" class="card-link">
                            <div class="card mx-1 mb-4" style="width: 18rem;">
                                <img src="' . htmlspecialchars($row->image_url) . '" class="card-img-top" alt="' . htmlspecialchars($row->title) . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row->title) . '</h5>
                                    <p class="card-text">' . htmlspecialchars(explode('.', $row->description)[0]) . '.</p>
                                    <p class="card-text">Bedømmelse: ' . htmlspecialchars($row->rating) . ' / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                                    <span class="btn btn-primary">Læs mere om bogen</span>
                                </div>
                            </div>
                          </a>';
                $cardCount++;

                if ($cardCount % 4 === 0 && $cardCount < count($result)) {
                    echo '</div></div>';
                    echo '<div class="carousel-item"><div class="d-flex justify-content-center flex-wrap">';
                }
            }

            echo '</div></div>';
        }
        ?>
    </div>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            <a href="krimi.php" class="btn btn-secondary">Se alle krimibøger</a>
        </div>
    </div>
</div>

<br>
<br>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h3 class="my-5 text-info">Populære biografier</h3>
        </div>
    </div>
</div>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM bio_books ORDER BY rating DESC LIMIT 8";
        $result = $db->sql($sql);

        if (empty($result)) {
            echo "<p>Ingen bøger blev fundet.</p>";
        } else {
            $active = 'active';
            $cardCount = 0;

            echo '<div class="carousel-item ' . $active . '"><div class="d-flex justify-content-center flex-wrap">';

            foreach ($result as $row) {
                echo '<a href="review_bio.php?id=' . htmlspecialchars($row->id) . '" class="card-link">
                            <div class="card mx-1 mb-4" style="width: 18rem;">
                                <img src="' . htmlspecialchars($row->image_url) . '" class="card-img-top" alt="' . htmlspecialchars($row->title) . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row->title) . '</h5>
<p class="card-text">' . htmlspecialchars(explode('.', $row->description)[0]) . '.</p>
                                    <p class="card-text">Bedømmelse: ' . htmlspecialchars($row->rating) . ' / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                                    <span class="btn btn-primary">Læs mere om bogen</span>
                                </div>
                            </div>
                          </a>';
                $cardCount++;

                if ($cardCount % 4 === 0 && $cardCount < count($result)) {
                    echo '</div></div>';
                    echo '<div class="carousel-item"><div class="d-flex justify-content-center flex-wrap">';
                }
            }

            echo '</div></div>';
        }
        ?>
    </div>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            <a href="bio.php" class="btn btn-secondary">Se alle biografier</a>
        </div>
    </div>
</div>

<br>
<br>
<br>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php include("includes/footer.php"); ?>
</html>


