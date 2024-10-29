<?php
require "settings/init.php";

$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM books WHERE id = $bookId";
$result = $db->sql($sql);
$book = !empty($result) ? $result[0] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review']) && isset($_POST['rating'])) {
    $reviewText = htmlspecialchars($_POST['review']);
    $rating = (int)$_POST['rating'];

    $sql = "INSERT INTO reviews (book_id, review_text, rating) VALUES ($bookId, '$reviewText', $rating)";
    $db->sql($sql);

    echo "<p class='alert bg-secondary'>Tak for din anmeldelse!</p>";
}

$reviewSql = "SELECT * FROM reviews WHERE book_id = $bookId ORDER BY created_at DESC";
$reviews = $db->sql($reviewSql);
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
                <img src="<?php echo htmlspecialchars($book->image); ?>" class="img-fluid" alt="Beskrivelse af billede">
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
                <form action="" method="post">
                    <div class="form-group mt-4">
                        <label for="review">Skriv din anmeldelse:</label>
                        <textarea name="review" id="review" rows="4" class="form-control" required></textarea>
                    </div>

                    <div class="form-group mt-2">
                        <label>Vurdering:</label>
                        <div id="starRating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="fa fa-star" data-value="<?php echo $i; ?>"></span>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="0" required>
                    </div>

                    <button type="submit" class="btn btn-secondary mt-2">Send anmeldelse</button>
                </form>

            <br>


                <hr>

            <br>
                <h3>Anmeldelser:</h3>
                <?php if (!empty($reviews)): ?>
                    <div id="reviewContainer">
                        <?php foreach ($reviews as $index => $review): ?>
                            <div class="review mt-3 <?php echo $index >= 3 ? 'd-none extra-review' : ''; ?>">
                                <p><?php echo htmlspecialchars($review->review_text); ?></p>
                                <p>Vurdering: <?php echo htmlspecialchars($review->rating); ?> / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                                <small class="text-muted">Anmeldt den <?php echo htmlspecialchars($review->created_at); ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($reviews) > 3): ?>
                        <button id="showMoreBtn" class="btn btn-secondary mt-3">Se alle anmeldelser</button>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Ingen anmeldelser endnu.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll("#starRating .fa-star");
        const ratingInput = document.getElementById("rating");
        const showMoreBtn = document.getElementById("showMoreBtn");

        stars.forEach(star => {
            star.addEventListener("click", function() {
                const rating = this.getAttribute("data-value");
                ratingInput.value = rating;

                stars.forEach(s => {
                    if (s.getAttribute("data-value") <= rating) {
                        s.classList.add("checked");
                    } else {
                        s.classList.remove("checked");
                    }
                });
            });
        });

        if (showMoreBtn) {
            showMoreBtn.addEventListener("click", function() {
                document.querySelectorAll(".extra-review").forEach(review => {
                    review.classList.remove("d-none");
                });
                showMoreBtn.style.display = "none";
            });
        }
    });
</script>

<?php include("includes/footer.php"); ?>
</body>
</html>