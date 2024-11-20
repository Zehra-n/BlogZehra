<?php
session_start();
require "templates/header.php";

// Überprüfung, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user_id'])) {
    // Umleitung zur Login-Seite, falls nicht eingeloggt
    header("Location: signup.php");
    exit();
}
?>


<!-- <input type="hidden" id="author" name="author" value="<?php echo $_SESSION['username']; ?>"> -->


<?php
// Verbindung zur Datenbank herstellen
require_once '../models/database.php';

// Blog-Beiträge abrufen
$query = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = $pdo->query($query);

// Prüfen, ob es Blog-Beiträge gibt
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Definiere Variablen für Fehler und Erfolgsnachrichten
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Beispielhafte Validierung der Formulardaten
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username)) {
        $errors[] = 'Benutzername ist erforderlich.';
    }
    if (empty($password)) {
        $errors[] = 'Passwort ist erforderlich.';
    }
    if ($password !== $confirm_password) {
        $errors[] = 'Passwörter stimmen nicht überein.';
    }

    // Wenn keine Fehler vorhanden sind, führe die Registrierung aus (z.B. in die DB speichern)
    if (empty($errors)) {
        // Hier kannst du die Registrierung in die Datenbank oder eine andere Logik einfügen
        $success = 'Registrierung erfolgreich!';
    }
}
?>

<?php if ($success): ?>
    <div class="success-box">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul class="error-box list-unstyled p-3 mb-3">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
