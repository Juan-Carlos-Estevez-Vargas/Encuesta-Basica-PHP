<?php
    include 'php/model/survey.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Encuesta</title>
</head>
<body>
    <form action="#" method="post">
        <?php
            $survey = new Survey(); //Instancia de la clase Survey
            $show_results = false; //Bandera

            if (isset($_POST['lenguaje'])){ //Si existe la opcion seeccionada
                $show_results = true; //Cambiamos el valor de la bandera
                $survey->setOptionSelected($_POST['lenguaje']); //Seteamos la opción seleccionada
                $survey->vote(); //Realizamos el voto
            }
        ?>

        <h2>¿Cual es tu lenguaje de programación favorito?</h2>
        
        <?php
            if ($show_results){ //Si la bandera es verdadera
                $languajes = $survey->showResults(); //Almacenamos los resiltados de la consulta
                echo '<h2>' . $survey->getTotalVotes() . ' votos totales</h2>'; //Total votos
                
                //Iterando el resultado de la consulta de los votos de los lenguajes
                foreach($languajes as $languaje){ 
                    //Para cada lenguaje almacenadoa el porcentaje de los votos e incluimos los resultados
                    $percent = $survey->getPercentageVotes($languaje['votos']); 
                    include 'php/view/view_result.php';
                }
            } else {
                include 'php/view/view_vote.php';
            }
        ?>
    </form>

</body>
</html>