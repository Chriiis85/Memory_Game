<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    session_start();
    /*La carta incia validada*/
    /*Si la carta es par y es mayor que 2 y menor que 61*/
    if ($_POST['numcartas'] % 2 == 0 && ($_POST['numcartas'] > 2 && $_POST['numcartas'] < 61)) {
        $_SESSION['numjugadas'] = 0;
        $_SESSION['numerodecartas'] = $_POST['numcartas'];
        
        $_SESSION['validacarta'] = 1;

        //Reiniciar los valores para una nueva partida
        $_SESSION['carta1'] = 0;
        $_SESSION['carta2'] = 0;
        $_SESSION['numjugadas'] = 0;
        $_SESSION['primerjuego'] = true;
        header('Location: memory.php');
    }
    /*Si la carta no es par y es menor que 2 y mayor que 40 */else {
        header('Location: index.php');
        $_SESSION['validacarta'] = 0;
    }
    ?>
</body>

</html>