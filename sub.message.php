<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour soumettre un message.";
    exit;
}
?>

<h2>Soumettre un message</h2>
<form action="sub.message.php" method="POST">
    <textarea name="message" placeholder="Votre message" required></textarea>
    <button type="submit">Envoyer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        if ($stmt->execute([$_SESSION['user_id'], $message])) {
            echo "Message soumis avec succès ! <a href='index.php'>Voir tous les messages</a>";
        } else {
            echo "Erreur lors de la soumission du message.";
        }
    } else {
        echo "Le message ne peut pas être vide.";
    }
}
?>
