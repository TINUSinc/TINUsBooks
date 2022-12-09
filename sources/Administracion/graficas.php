<?php
    include("adminNavBar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/graficasStyle.css">
    <title>Gráficas</title>
</head>

<body>
    <div>
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
            <br><br>
            <p id="btnEnviar"><input type="submit" name="enviar" value="Enviar"></p>
        </form>
        <?php
            if (isset($_POST['enviar'])) {
                switch ($_POST['mes']) {
                    case 1:
                        $mes="Enero";
                        break;
                    case 2:
                        $mes="Febrero";
                        break;
                    case 3:
                        $mes="Marzo";
                        break;
                    case 4:
                        $mes="Abril";
                        break;
                    case 5:
                        $mes="Mayo";
                        break;
                    case 6:
                        $mes="Junio";
                        break;
                    case 7:
                        $mes="Julio";
                        break;
                    case 8:
                        $mes="Agosto";
                        break;
                    case 9:
                        $mes="Septiembre";
                        break;
                    case 10:
                        $mes="Octubre";
                        break;
                    case 11:
                        $mes="Noviembre";
                        break;
                    case 12:
                        $mes="Diciembre";
                        break;
                }
                $anio = $_POST['ano'];
                ?>
    </div>

    <div class="container text-center my-4">
        <h1 class="h2 mb-3 font-weight-normal">Graficas</h1>
        <div class="contenedor">
            <br>
            <div class="grafica1">
                <h2>Compras</h2>
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
                        'title': <?php echo "'" .$mes." ".$anio. "'" ?>,
                        'width': 550,
                        'height': 600,
                        'backgroundColor': {
                            fill: "gainsboro"
                        },
                        'pieHole': 0.4

                    };

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
                </script>

                <!--Div that will hold the pie chart-->
                <div id="chart_div"></div>
            </div>
        </div>
    </div>

    <div class="container text-center my-4">
        <h1 class="h2 mb-3 font-weight-normal">Graficas</h1>
        <div class="contenedor">
            <br>
            <div class="grafica1">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                google.charts.load("current", {
                    packages: ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ["Producto", "Cantidad", {
                            role: "style"
                        }],

                        <?php
                            $numConsulta = getProductosMasVendidos($_POST['mes'], $_POST['ano']);
                            if($numConsulta == 0){
                                echo "['Sin ventas', 0, 'blue']";
                            }else{
                                foreach($numConsulta as $valor) {
                                    echo "['".$valor["Nombre_Prod"]. "'," .$valor["SUM(Cant_Prod)"]. ", 'blue'],";
                                }
                            }
                        ?>
                    ]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                        {
                            calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation"
                        },
                        2
                    ]);

                    var options = {
                        title: "Density of Precious Metals, in g/cm^3",
                        width: 600,
                        height: 400,
                        bar: {
                            groupWidth: "95%"
                        },
                        legend: {
                            position: "none"
                        },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                    chart.draw(view, options);
                }
                </script>
                <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
            </div>
        </div>
        <?php
            }
        ?>
        
</body>

</html>
<?php
    include_once("../PHP/footer.php");
?>