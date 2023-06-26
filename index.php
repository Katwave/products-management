<?php
include 'template.php';
?>

<!-- For testing -->
<?= console_log(doesProductExistInCategory('Kids', 'Toy car')) ?>
<?= console_log($testData->mainData) ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
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

        <div id="prod-info"></div>
    </div>

    <script src="./main.js"></script>
</body>
</html>