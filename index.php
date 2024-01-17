<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width: 100vw;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 25px;
    }

    .dificultad-container {
        margin-bottom: 200px;
        width: 70%;
        height: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        gap: 25px;
        border: 5px;
        background-color: green;
        border: 3px solid;
        box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;

    }

    .contbotones {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        gap: 25px;
    }

    .t56 {
        font-family: "Open Sans", sans-serif;
        font-size: 50px;
        letter-spacing: 2px;
        text-decoration: none;
        text-transform: uppercase;
        color: #000;
        border: 3px solid;
        padding: 0.25em 0.5em;
        box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
        position: relative;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-56 {
        font-family: "Open Sans", sans-serif;
        font-size: 50px;
        letter-spacing: 2px;
        text-decoration: none;
        text-transform: uppercase;
        color: #000;
        border: 3px solid;
        padding: 0.25em 0.5em;
        box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
        position: relative;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        cursor: pointer;
    }
</style>

<body>
    <?php
    session_start();
    $_SESSION['validacarta'] = 1;
    /*Si la carta no pasa la validacion mostramos el mensaje, en el otro caso redirigiremos a la pagina para jugar*/
    if ($_SESSION['validacarta'] == 0) {
        echo "<h3 style='color:red; margin-top:100px;'>Introduzca correctamente el numero de cartas</h3>";
    } else {
        header("memory.php");
    }

    ?>
    <h1 class="t56">CONFIGURAR JUEGO</h1>
    <!--Formulario para cambiar la configuracion y el numero de cartas-->
    <div class="dificultad-container">
        <form action="redirect.php" method="post">
            <h1 style="color: white; font-size:20px;">Indique el numero de figuras a mostrar: &nbsp; <input
                    type="number" name="numcartas" value="4">
            </h1>
            <br>
            <div class="contbotones">
                <input style="font-size:20px;font-weight:bold;" class="button-56" type="submit" value="Iniciar Partida">
                <input style="font-size:20px;font-weight:bold;" class="button-56" type="reset"
                    onclick="'Location: '.$_SERVER['PHP_SELF']" value="Reiniciar Configuración">
            </div>
        </form>
    </div>
</body>

</html>