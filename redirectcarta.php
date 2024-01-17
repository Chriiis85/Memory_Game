<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    session_start();

    //Recoger carta que estamos recibiendo
    $cartaActual = $_SESSION[$_POST['carta']];

    //Si se clica el boton de jugar un nuevo juego reseteamos todas las cartas
    if (isset($_POST['newgame'])) {
        $_SESSION['carta1'] = 0;
        $_SESSION['carta2'] = 0;
        $_SESSION['numjugadas'] = 0;
        $_SESSION['primerjuego'] = true;
    } else {
        //Indicamos que no es el primer juego para cuando redirijamos entrar al bucle correcto
        $_SESSION['primerjuego'] = false;
        //Si la carta 1 esta vacia guardamos la carta actual para darle la vuelta
        if ($_SESSION['carta1'] == 0) {
            $_SESSION['carta1'] = $cartaActual;
        }
        //Si la carta 1 esta llena y la carta 2 vacia guardamos la carta actual para darle la vuelta
        else if ($_SESSION['carta2'] == 0) {
            $_SESSION['carta2'] = $cartaActual;
        }
        //Si las cartas contienen algo dentro estas se darán la vuelta al ser la tercera carta que se clicka
        else {
            $_SESSION['carta1'] = 0;
            $_SESSION['carta2'] = 0;

            //Incrementar el numero de jugadas
            $_SESSION['numjugadas'] = $_SESSION['numjugadas'] + 1;
        }
    }

    //Redirigimos automaticamente al juego
    header('Location: memory.php');
    ?>
</body>

</html>