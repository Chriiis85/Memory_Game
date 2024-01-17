<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
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

    .estilocuadro {
        font-family: "Open Sans", sans-serif;
        font-size: 30px;
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
        border-bottom: -100px;
    }

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
        overflow-y: hidden;
    }

    .ganado {
        width: 1400px;
        height: 525px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: wheat;
        position: absolute;
        z-index: 99;
    }

    .contcarta {
        width: 1400px;
        height: 525px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 25px;
        background-color: green;
        border: 3px solid;
        box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
    }

    .carta {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 90px;
        border: 3px solid black;
        font-size: 55px;
        background-color: white;
        box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
        transition: 0.5s;
    }

    .carta p {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .carta input {
        z-index: 99;
        opacity: 0.0001;
        width: 100%;
        height: 100%;
        color: transparent;
    }

    .carta input:hover {
        cursor: pointer;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
</style>

<body>
    <?php
    session_start();
    /*Crear baraja con todos los simbolos de los animales*/
    $baraja_cartas = array();
    /*Introducir en la baraja con todos los simbolos de los animales*/
    for ($i = 128000; $i < 128060; $i++) {
        array_push($baraja_cartas, $i);
    }

    ?>
    <h1 class="estilocuadro ">MEMORY</h1>
    <!--Formulario para la cabecera y botones para crear una nueva partida  cambiar el numero de cartas-->
    <form action="redirectcarta.php" method="post">
        <!--Boton para crear una nueva partida-->
        <input style="font-size:20px; font-weight:bold;" class="button-56" type="submit" value="Nueva Partida"
            name="newgame">
        <!--Boton para cambiar el numero de cartas-->
        <input style="font-size:20px; font-weight:bold;" class="button-56" type="button"
            value="Cambiar Numero de Cartas" onclick="location='index.php'" />
        <?php
        //Mostrar el numero de jugadas que se lleva
        echo "<h3 class='button-56' style='font-size:20px; cursor:auto;' class='estilocuadro '>Jugadas realizadas: " . $_SESSION['numjugadas'] . "</h3>";
        ?>
    </form>
    <?php
    //Booleano para controlar si ha terminado la partida
    $hasganado = true;

    if ($_SESSION['primerjuego'] == true) {
        /*Seleccionar par de cartas*/
        $mitad = $_SESSION['numerodecartas'] / 2;
        /*Array para tener solo las cartas disponibles sin repetir y escoger random entre ellas*/
        $baraja_cartas_disp = array();
        /*Juntar todas las cartas y multiplicarlas por 2*/
        for ($i = 0; $i < $mitad; $i++) {
            array_push($baraja_cartas_disp, $baraja_cartas[$i]);
            array_push($baraja_cartas_disp, $baraja_cartas[$i]);
        }
        /*Mezclar toda las cartas*/
        shuffle($baraja_cartas_disp);
        $baraja_total = array();
        //Crear un array que contenga el numero de la carta, si esta dado la vuleta y el indice para tener la posicion
        foreach ($baraja_cartas_disp as $key => $value) {
            $carta = array('carta' => $value, 'vuelta' => 0, 'indice' => $key);
            array_push($baraja_total, $carta);
            $_SESSION["card$key"] = $carta;
        }
        //Guardar la baraja en una sesion y poder manejarla
        $_SESSION['arraycartas'] = $baraja_total;
    } else {
        //Guardar en la baraja actual el array con la baraja que tenemos en la sesion
        $baraja_total = $_SESSION['arraycartas'];
    }

    /*Mostrar toda las cartas*/
    echo '<form action="redirectcarta.php" method="post">';
    //Booleanos que controlan si la carta esta mostrada para dar la vuelta o dar la vuelta cuando se clica la tercera
    $carta1mostrada = false;
    $carta2mostrada = false;

    echo '<div class="contcarta">';

    for ($i = 0; $i < $_SESSION['numerodecartas']; $i++) {
        echo '<div class="carta">';
        if ($_SESSION["card$i"]['vuelta'] === "1") {
            echo '<p>&#' . $_SESSION["card$i"]["carta"] . ';</p>';
        } else {
            if ($_SESSION["carta1"] != 0 && $_SESSION["card$i"]['carta'] == $_SESSION['carta1']["carta"] && $_SESSION["carta1"]['indice'] == $i && $carta1mostrada == false) {
                echo '<p>&#' . $_SESSION['carta1']["carta"] . ';</p>';
                $carta1mostrada = true;
            } else if ($_SESSION["carta2"] != 0 && $_SESSION["card$i"]['carta'] == $_SESSION['carta2']["carta"] && $_SESSION["carta2"]['indice'] == $i && $carta2mostrada == false) {
                echo '<p>&#' . $_SESSION['carta2']["carta"] . ';</p>';
                $carta2mostrada = true;
            } else {
                echo '<p>&#10026;</p><input type="submit" name="carta" value="card' . $i . '">';
            }

            if ($_SESSION["carta1"] != 0 && $_SESSION["carta2"] != 0 && $_SESSION["carta1"]["carta"] == $_SESSION["carta2"]["carta"]) {
                if ($_SESSION["carta1"]["indice"] == $i || $_SESSION["carta2"]["indice"] == $i) {
                    $_SESSION["card$i"]["vuelta"] = "1";
                }
            }
        }
        echo '</div>';
    }
    echo '</div>';
    //Recorrer el array donde tenemos todas las cartas y comprobar si estan dadas la vuelta o no
    for ($i = 0; $i < $_SESSION['numerodecartas']; $i++) {
        if ($_SESSION["card$i"]['vuelta'] == 0) {
            //Con que se encuentre una unica carta sin dar la vuelta el booleano lo ponemos en false y salimos del bucle
            $hasganado = false;
            break;
        }
    }

    //Si en el anterior bucle no se encuantra ninguna boca abajo indicamos que ha ganado y redirigimos
    if ($hasganado == true) {

        echo '<div class="ganado">';
        echo '<h1 class="estilocuadro" style="background-color: white;">ENHORABUENA!!! HAS GANADO<h1>';
        ?>
        <input style="font-size:20px; font-weight:bold;" class="button-56" type="button" value="Cerrar Ventana"
            onclick="location='index.php'" />
        <?php
        echo '</div>';
        //header("Refresh: 0.5; 'Location: ganado.php'");
    }
    echo "</form>";

    ?>

</body>

</html>