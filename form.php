<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="" media="all">
</head>
<body>
        <form action="form.php" method="post">

        <?php if (isset($_GET['error'])) { ?>
            <p style=" " id="error"><?php echo $_GET['error']; ?></p> 
        <?php }?>

        </form>

</body>
</html>

<?php 
$dsn = "mysql:host=localhost;dbname= mettre_le_nom";
$username = "root";
$password = "";

$conn = new PDO($dsn, $username, $password);

if (!$conn) {
    echo "Echec de la connection";
}

function validate ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ( isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message']) ){
    $nom = validate($_POST['nom']);
    $email = validate($_POST['email']);
    $sujet = validate($_POST['sujet']);
    $message = validate($_POST['message']);

    if (empty($nom)) {
        header ("Location:form.php?error=.....");
        exit();
    }
    if (empty($email)) {
        header ("Location:form.php?error=.....");
        exit();
    }

    if (empty($sujet)) {
        header ("Location:form.php?error=.....");
        exit();
    }

    if (empty($message)) {
        header ("Location:form.php?error=......");
        exit();
    }

    $sql = "INSERT INTO base-de-données (nom, email, sujet, message) VALUES (?,?,?,?)";
    $stmt = $conn ->prepare($sql);
    $feedback = $stmt ->execute([$nom, $email, $sujet, $message]);
    mail($umail, "Message de confirmation", "Votre message a bien été envoyé");
}
else {
    header("Location:form.php");
    exit();
}

?>