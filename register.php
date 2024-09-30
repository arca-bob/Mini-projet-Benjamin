<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<h2>Inscription</h2>
<form action="register.php" method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Tous les champs doivent être remplis.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            echo "Nom d'utilisateur déjà pris.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashedPassword])) {
                echo "Inscription réussie ! <a href='login.php'>Connectez-vous ici</a>.";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }
}
?>
