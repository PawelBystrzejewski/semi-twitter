<?php

require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password1']) &&
        isset($_POST['password2'])) {


        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if (User::loadUserByEmail($conn, $email) != null) {

            echo "Ten e-mail jest już zajęty.";
            
        } elseif ($_POST['password1'] != $_POST['password2']) {

            echo "Hasła się nie zgadzają.";
            
        } else {

            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($username);
            $newUser->setPassword($password1);
            
            $result = $newUser->saveToDB($conn);
            
            if($result) {
                echo "Dodano do bazy użytkownika <strong>" . $newUser->getUsername() . "</strong>";
            }
            
            
            
        }
    } else {
        echo "Brakujące dane.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css"
              <title></title>
    </head>
    <body>

        <table>

            <form action="#" method="POST">
                <tr>
                    <td colspan="3">
                        <h3>Tworzenie nowego konta</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nazwa użytkownika:
                    </td>
                    <td colspan="2">

                        <input class="login" type="text" name="username">

                    </td>
                </tr>
                <tr>
                    <td>
                        E-mail:
                    </td>
                    <td colspan="2">

                        <input class="login" type="text" name="email">

                    </td>
                </tr>
                <tr>
                    <td>Hasło:</td>
                    <td colspan="2">

                        <input class="login" type="password" name="password1">
                    </td>
                </tr>
                <tr>
                    <td>Powtórz hasło:</td>
                    <td colspan="2">

                        <input class="login" type="password" name="password2">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">

                        <input class="tableButton" type="submit" value="Załóż konto">
                    </td>
                </tr>
            </form>
            <tr>
                <td colspan="3"><a href="login.php">Wróć do ekranu logowania</a></td>
            </tr>
        </table>



    </body>
</html>

