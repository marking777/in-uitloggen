<?php
    include 'db.php';

    try {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $db = new Database();
        $user = $db->inloggen($email);

        if ($user) {
            $wachtwoord = $_POST['password'];
            $verify = password_verify($wachtwoord, $user['password']);
            if ($user && $wachtwoord == $verify) {
                session_start();
                $_SESSION['ID'] = $user['id'];
                $_SESSION['naam'] = $user['naam'];
                header('Location:home2.php?ingelogd');
            } else {
                echo "fout";
            }
        } else {
            echo "error";
        }
    }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inloggen.css">
    <title>Document</title>
</head>
<body>
    <h1>inloggen</h1>
    <div class="input">
    <form method="POST">

    <input type="text" name="email" placeholder="Email">
  
    <input type="password" name="password" placeholder="Wachtwoord">

  <button type="submit">Verzenden</button>

</div>

</form>
</body>
</html>