<?php
    include("adminNavBar.php");
?>

<html>

<head>
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
