<?php
    include_once("conexion.php");                                   

function getVentasMes($mes, $año){
    /**
     * Retorna las ventas en el mes y año seleccionado.
     * -Si en el mes no hay ventas, retorna 0
     * -Si en el mes hay ventas retorna un array con array de la siguiente forma:
     * $array[numeroDeConsulta]["Nom_Cat_Prod"] indica el nombre de la categoria
     * $array[numeroDeConsulta]["venta"] indica la cnatidad vendida de la categoria
     * se recomienda usar un foreach para recorrerlo, de forma que quede:
     * foreach($array as $numConsulta){
     *  $numConsulta["Nom_Cat_Prod"]; //Indica la categoria
     *  $numConsulta["venta"]; //Indica la cantidad vendida
     * }
     * 
     */
    global $conexion;
    $fechaInicio = date("Y-m-d", mktime(0,0,0,$mes,1,$año));
    $fechaFinal = date("Y-m-d", mktime(0,0,0,($mes+1),0,$año));
    $query = 'SELECT Precio_Prod, Cant_Prod, Descuento_Prod, Nom_Cat_Prod FROM detalle_compra D, compra C WHERE C.Fecha_Compra>="'.$fechaInicio.'" AND C.Fecha_Compra<="'.$fechaFinal.'" AND C.Id_Compra=D.idCompra_Compra ;';
    $datos = $conexion->query($query);
    $retornar = array();
    $calculo = array();
    $cont = 0;
    if($datos->num_rows){
        while($fila = $datos->fetch_assoc()){
            if(!isset($calculo[$fila["Nom_Cat_Prod"]])) $calculo[$fila["Nom_Cat_Prod"]] = 0;
            $calculo[$fila["Nom_Cat_Prod"]] += ($fila["Precio_Prod"] * $fila["Cant_Prod"])-($fila["Precio_Prod"] * $fila["Cant_Prod"] * $fila["Descuento_Prod"] * 0.01);
        }
        $query = 'SELECT DISTINCT Nom_Cat_Prod FROM detalle_compra';
        $datos = $conexion->query($query);
        while($fila = $datos->fetch_assoc()){
            $fila["venta"] = $calculo[$fila["Nom_Cat_Prod"]];
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }
    return 0;
}

?>

<html>

<head>
    <!--Load the AJAX API-->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
   
   <form method="post" action="graficas.php">
    <select name="mes">
        <?php
        for ($i=1; $i<=12; $i++) {
            if ($i == date('m'))
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
    </select>

    <select name="ano">
        <?php
        for($i=date('o'); $i>=2022; $i--){
            if ($i == date('o'))
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>

    </select>
    
    <p><input type="submit" name="enviar" value="enviar"></p>
    
    </form>
    <?php
        if (isset($_POST['enviar'])) {
           // echo 'Fecha recibida: '.$_POST['dia'].'/'.$_POST['mes'].'/'.$_POST['ano'];?>

    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.


        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable([]);

            data.addColumn('string', 'Categoria');
            data.addColumn('number', 'Cantidad');

            data.addRows([
                <?php
                $numConsulta = getVentasMes($_POST['mes'], $_POST['ano']);
                
                if ($numConsulta == 0) {
                    echo "['Sin ventas', 100]";
                } else{
                    foreach($numConsulta as $valor) {
                        echo "['".$valor["Nom_Cat_Prod"]. "'," .$valor["venta"]. "],";
                    }
                    }
                    ?>
            ]);


        // Set chart options
        var options = {
            'title': 'Compras',
            'width': 400,
            'height': 300
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }

    </script>
<?php
    }
    ?>


    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
</body>

</html>
