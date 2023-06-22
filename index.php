<?php
include 'template.php';
?>

<?= console_log(getProductsInCategory('Kids')) ?>
<?= console_log(doesProductExistInCategory('Kids', 'Toy car')) ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Left Panel -->
        <?php
        include './parts/left-panel.php';
        ?>
        <!-- Right Panel -->
        <?php
        include './parts/right-panel.php';
        ?>
    </div>

    <script src="./main.js"></script>
</body>
</html>