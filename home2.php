<?php
include 'db.php';
$db = new Database();
$pdo = $db->pdo;

session_start();

if (isset($_SESSION['ID'])) {
    echo "Ingelogd als: " . $_SESSION['ID'];
    echo "<br><a href=uitloggen.php>Logout</a>";
} else {
    header("Location:inloggen.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db->insertUser($_POST['email'], $_POST['password']);
        echo "Successfully added";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="input">
    <form method="POST">
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <input type="submit">
        
    </form>
</div>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>

        </tr>

        <tr> <?php
            $user = $db->selectAllUsers();
            
            if ($user) { 
                foreach ($user as $user) {?>
            <td><?php echo $user['id'];?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo $user['password']?></td>
           <td class="edit"><a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a></td>
           <td class="delete"><a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
            <td></td>
        </tr> <?php } }?>
        </tr>
    </table>
</body>
</html>