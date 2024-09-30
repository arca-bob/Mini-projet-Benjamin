<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="sub.message.php">Soumettre un message</a>
                <a href="logout.php">Déconnexion</a>
            <?php else: ?>
                <a href="login.php">Connexion</a>
                <a href="register.php">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>
