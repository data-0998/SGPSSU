<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->titulo ?></title>
</head>
<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>

    <h1><?= $this->mensaje; ?></h1>
    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>