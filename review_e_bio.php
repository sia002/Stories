<?php
require "settings/init.php";

$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM e_bio_books WHERE id = $bookId";
$result = $db->sql($sql);
$book = !empty($result) ? $result[0] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])) {
    $reviewText = htmlspecialchars($_POST['review']);

    $sql = "INSERT INTO reviews (book_id, review_text) VALUES ($bookId, '$reviewText')";
    $db->sql($sql);

    echo "<p class='alert bg-secondary'>Tak for din anmeldelse!</p>";
}
?>

<!DOCTYPE html>
<html lang="da">
<?php include("includes/header.php"); ?>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <?php if ($book): ?>
                <img src="<?php echo htmlspecialchars($book->image_url); ?>" class="img-fluid" alt="Beskrivelse af billede">
            <?php else: ?>
                <p>Bogen blev ikke fundet.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <?php if ($book): ?>
                <h2><?php echo htmlspecialchars($book->title); ?></h2>
                <p><?php echo htmlspecialchars($book->description); ?></p>
                <p>Bedømmelse: <?php echo htmlspecialchars($book->rating); ?> / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>


                <br>
            <?php endif; ?>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php include("includes/footer.php"); ?>

</body>
</html>