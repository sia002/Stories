<?php
require "settings/init.php";

$query = isset($_GET['query']) ? $_GET['query'] : '';
$results = [];

if ($query) {
    $tables = ['bio_books', 'fantasy_books', 'krimi_books', 'skon_books', 'e_skon_books', 'e_bio_books'];

    foreach ($tables as $table) {
        $sql = "SELECT title, description, image_url, rating, '$table' as source 
                FROM $table 
                WHERE title LIKE :query OR description LIKE :query";

        $tableResults = $db->sql($sql, [':query' => '%' . $query . '%'], true);

        if ($tableResults) {
            $results = array_merge($results, $tableResults);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<?php include("includes/header.php"); ?>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container my-5">
    <h2 class="text-center">Søgeresultater</h2>

    <br>
    <br>

    <?php if (!empty($results)): ?>
        <div class="row">
            <?php foreach ($results as $book): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo htmlspecialchars($book->image_url); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book->title); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($book->title); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($book->description, 0, 100)) . '...'; ?></p>
                            <p class="card-text">Bedømmelse: <?php echo htmlspecialchars($book->rating); ?> / 5 <i class="fa-solid fa-star" style="color: #d8b266;"></i></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Ingen resultater fundet for "<?php echo htmlspecialchars($query); ?>"</p>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>
</body>
</html>