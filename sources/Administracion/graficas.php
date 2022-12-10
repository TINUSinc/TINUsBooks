<?php
    include("adminNavBar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/graficasStyle.css">
    <title>Gráficas</title>

</head>
<body style="background-color: rgb(239, 239, 205);">
<?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
    <div class="container text-center my-4" style=" background-color:rgb(239, 239, 205);">
        <br>    
        <h1 class="h2 mb-3 font-weight-normal">Graficas</h1>
        <form method="post" action="graficas.php">  
            <div class="row justify-content-center">
                <div class="row col-12 col-md-8 col-lg-6 col-xl-4">
                    <div class="col-6 my-3">
                        <select name="mes" class="form-select">
                            <?php
                                for ($i=1; $i<=12; $i++) {
                                    if ($i == date('m'))
                                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                    else
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 my-3">
                        <select name="ano" class="form-select col-6">
                            <?php
                                for($i=date('o'); $i>=2022; $i--){
                                    if ($i == date('o'))
                                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                    else
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 my-3">
                        <input type="submit" name="enviar" value="Enviar" class="btn btn-outline-dark">
                    </div>
                </div>
            </div>
        </form>
    </div>
        <?php
            if (isset($_POST['enviar'])):
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
    
    <div class="container">
        <h3 style="text-align: center;"><?php echo "" .$mes." ".$anio. "" ?></h3>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 text-center" style="background-color:rgb(239, 239, 205);">
                <h4>Géneros vendidos</h4>
                <script>
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
                            echo "['".$valor["Nom_Cat_Prod"]."', ".$valor["venta"]."],";

                        }
                        }
                        ?>
                    ]);


                    // Set chart options
                    var options = {
                        'title': "",
                        'backgroundColor': {
                            fill: "#EFEFCD"
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
            <div class="col-12 col-lg-6 text-center" style="background-color:rgb(239, 239, 205);">
                <h4>Títulos vendidos</h4>
                <script src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
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
                                echo "['Sin ventas', 0, '#19648C']";
                            }else{
                                foreach($numConsulta as $valor) {
                                    echo "['".$valor["Nombre_Prod"]. "'," .$valor["SUM(Cant_Prod)"]. ", '#19648C'],";
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
                        title: "",
                        bar: {
                            groupWidth: "95%"
                        },
                        legend: {
                            position: "none"
                        },
                        'backgroundColor': {
                            fill: "#EFEFCD"
                        }
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                    chart.draw(view, options);
                }
                </script>
                <div id="columnchart_values"></div>
            </div>
        </div>
    </div>
    <br><br><br>
    <?php else: ?>
        <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br>
    <?php endif; ?>
<?php else: ?>
    <h1 class="text-center titulos">Inicie sesión</h1>
    <div class='container-fluid'>
        <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
            Para poder ver esta página necesita iniciar sesión y ser administrador.
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
<?php endif ?>
</body>
</html>
<?php
    include_once("../PHP/footer.php");
?>