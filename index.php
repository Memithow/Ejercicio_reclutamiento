<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
        $query = $conn->query('SELECT count(color) AS cont, color FROM users u GROUP BY color ORDER BY color;');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query_rows = $conn->query('SELECT email, color FROM users u;');
        $query_rows->execute();
        $rows = $query_rows->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>

<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>

    <div class="row jusfify-content-end">
        <a href="logout.php" class="fw-bolder text-end">Cerar sesión</a>
    </div>

    <h1 class="text-center">Bienvenido <span class="fw-normal"><?= $user['email'];?></span></h1>

    <!-- HTML -->
    <div id="chartdiv"></div>

    <!--DataTables-->
    <div class="row justify-content-center">
        <div class="col-6">
            <h3 class="text-center my-5">Usuarios registrados</h3>
            <table id="tabla_usuarios" class="display" width="100%">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Color</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



    <!-- Chart code -->
    <script>
        const rows_color = JSON.parse(<?php echo "'".json_encode($rows)."'";?>);
        var data = JSON.parse(<?php  echo "'".json_encode($data)."'";?>);

        $(document).ready(function() {
            $('#tabla_usuarios').DataTable( {
                data: rows_color,
                columns: [
                    { data: "email" },
                    { data: "color" },
                ]
            } );
        } );

        am5.ready(function() {

            var root = am5.Root.new("chartdiv");

            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    endAngle: 270,
                })
            );

            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "cont",
                    categoryField: "color",
                    endAngle: 270,
                })
            );

            series.slices.template.setAll({
                fillOpacity: 1,
                stroke: am5.color(0xffffff),
                strokeWidth: 2,
                templateField: "columnSettings"
            });

            for (let i = 0; i < data.length; i++) {
                switch (data[i].color){
                    case 'Rojo': data[i].columnSettings = {fill: am5.color(0xFF0000)}
                    break;
                    case 'Verde': data[i].columnSettings = {fill: am5.color(0x008000)}
                    break;
                    case 'Azul': data[i].columnSettings = {fill: am5.color(0x0000FF)}
                    break
                }
            }

            series.data.setAll(data);

            series.appear(1000, 100);

        });

    </script>

<?php else: ?>

<div class="row justify-content-center">
    <h1 class="text-center my-5">Prueba técnica – Full Stack PHP</h1>
    <p class="text-center"><a class="btn btn-primary mx-2" href="login.php">Iniciar sesión</a> <a class="mx-2 btn btn-secondary" href="signup.php">Registrate</a></p>

</div>


<?php endif; ?>


<?php require 'partials/footer.php' ?>

