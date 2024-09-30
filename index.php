<?php
include 'header.php';
include 'config.php';

// Récupération des messages avec le nom d'utilisateur associé
$stmt = $pdo->prepare("
    SELECT messages.id, messages.message, messages.created_at, users.username
    FROM messages
    JOIN users ON messages.user_id = users.id
    ORDER BY messages.created_at DESC
");
$stmt->execute();
$messages = $stmt->fetchAll();
?>

<h2>Messages</h2>

<?php if ($messages): ?>
    <?php foreach ($messages as $msg): ?>
        <div class="message">
            <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
            <p class="meta">Posté par <strong><?php echo htmlspecialchars($msg['username']); ?></strong> le <?php echo date("d/m/Y H:i", strtotime($msg['created_at'])); ?></p>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $msg['id']): ?>
                
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun message pour le moment. Soyez le premier à laisser un message !</p>
<?php endif; ?>


