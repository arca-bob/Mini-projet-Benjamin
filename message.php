<?php
include 'header.php';
include 'config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être <a href='login.php'>connecté</a> pour soumettre un message.</p>";
    include 'footer.php';
    exit;
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['message']);

    // Validation du message
    if (empty($message)) {
        $errors[] = "Le message ne peut pas être vide.";
    }

    // Sécurisation des données
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        if ($stmt->execute([$_SESSION['user_id'], $message])) {
            $success = "Message soumis avec succès !";
            // Optionnel : rediriger vers la page d'accueil
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Erreur lors de la soumission du message.";
        }
    }
}
?>

<h2>Ajouter un Message</h2>

<?php
if ($errors) {
    echo '<div class="errors"><ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul></div>';
}

if ($success) {
    echo '<div class="success">' . $success . '</div>';
}
?>

<form action="sub.message.php" method="POST">
    <label for="message">Votre message :</label>
    <textarea id="message" name="message" required><?php echo isset($message) ? htmlspecialchars($message) : '' ?></textarea>

    <button type="submit">Envoyer</button>
</form>

