<?php
require "settings/init.php";

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';

if ($sort === 'az') {
    $orderBy = "ORDER BY title ASC";
} elseif ($sort === 'za') {
    $orderBy = "ORDER BY title DESC";
} else {
    $orderBy = "ORDER BY rating DESC";
}

$limit = 15;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$sql = "SELECT * FROM e_skon_books $orderBy LIMIT $limit OFFSET $offset";
$result = $db->sql($sql);
?>

<!DOCTYPE html>
<html lang="da">
<?php include("includes/header.php"); ?>

<!DOCTYPE html>
<html lang="da">
<?php include("includes/header.php"); ?>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h1 class="my-5 text-dark">Biografier</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h3 class="my-5 text-info">Populære biografier</h3>
        </div>
    </div>
</div>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM e_skon_books ORDER BY rating DESC LIMIT 8";
        $result = $db->sql($sql);

        if (empty($result)) {
            echo "<p>Ingen bøger blev fundet.</p>";
        } else {
            $active = 'active';
            $cardCount = 0;

            echo '<div class="carousel-item ' . $active . '"><div class="d-flex justify-content-center flex-wrap">';

            foreach ($result as $row) {
                echo '<a href="review_e_skon.php?id=' . htmlspecialchars($row->id) . '" class="card-link">
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

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Forrige</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Næste</span>
    </button>
</div>

<br>
<br>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <h3 class="my-5 text-info">Flere biografibøger</h3>
        </div>
    </div>
    <div class="row">
        <div class="col text-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Sorter efter
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item sort-option" href="?sort=az">A-Z</a></li>
                    <li><a class="dropdown-item sort-option" href="?sort=za">Z-A</a></li>
                    <li><a class="dropdown-item sort-option" href="?sort=rating">Bedste vurdering</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container mb-4">
    <div class="row justify-content-center" >

        <?php

        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = 15; // Antal bøger pr. anmodning

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';


        if ($sort === 'az') {
            $orderBy = "ORDER BY title ASC";
        } elseif ($sort === 'za') {
            $orderBy = "ORDER BY title DESC";
        } else { // Standard til bedømmelse sortering
            $orderBy = "ORDER BY rating DESC";
        }

        $sql = "SELECT * FROM e_skon_books $orderBy LIMIT $limit OFFSET $offset";
        $result = $db->sql($sql);

        // Debugging
        error_log("SQL: $sql");

        if (empty($result)) {
            exit;
        } else {
            foreach ($result as $row) {
                echo '<div class="col-4 col-md-3 col-lg-3 mb-4">
            <a href="review_e_skon.php?id=' . htmlspecialchars($row->id) . '" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="card text-center h-100">
                    <img src="' . htmlspecialchars($row->image_url) . '" class="card-img-top" alt="Book Image">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($row->title) . '</h5>
<p class="card-text">' . htmlspecialchars(explode('.', $row->description)[0]) . '.</p>
                        <p class="card-text">Bedømmelse: ' . htmlspecialchars($row->rating) . ' / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                        <span class="btn bg-primary">Læs mere om bogen</span>
                    </div>
                </div>
            </a>
        </div>';
            }
        }
        ?>


    </div>
</div>

<br>
<br>

<?php include("includes/footer.php"); ?>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>