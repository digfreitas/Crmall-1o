<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMALL</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Urbanist' rel='stylesheet'>
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
</head>
<?php
    $now = time();
    if  ($now > $_SESSION['expire']) {
        include('regras_frases.php');
    } else {
        $numeros_associados = $_SESSION['numeros_associados'];
        $fraseAtual = $_SESSION['frase_atual'];
    }
?>
<body>
    <div class="container">
        <h2 class="frase"> <?= $fraseAtual ?></h2>
        <div class="container-numeros">
            <?php foreach ($numeros_associados as $numero) :?>
                <?php $numero_formatado = sprintf("%02d", $numero); ?>
                <div class="box"><p class="box-content"><?= $numero_formatado ?></p></div>
            <?php endforeach; ?>
        </div> 
        <div class="container-imagens">
            <img src="assets/logo-crmall.png" alt="logo crmall">
            <img src="assets/logo-prizor.png" alt="logo prizor">
        </div>
    </div>   
</body>
</html>
