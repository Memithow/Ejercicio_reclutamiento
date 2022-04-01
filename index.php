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

        $query = $conn->query('
            SELECT count(color) AS cont, color
                FROM users u 
            GROUP BY color;');

        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>

<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>

    <div class="row jusfify-content-end">
        <a href="logout.php" class="fw-bolder text-end">Cerar sesión</a>
    </div>

    <h1 class="text-center">Bienvenido <span class="fw-normal"><?= $user['email'];?></span></h1>

    <!-- Chart code -->
    <script>
        const data = JSON.parse(<?php  echo "'".json_encode($data)."'";?>);

        am5.ready(function() {

            var root = am5.Root.new("chartdiv");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    endAngle: 270
                })
            );

            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "cont",
                    categoryField: "color",
                    endAngle: 270
                })
            );

            series.states.create("hidden", {
                endAngle: -90
            });

            series.data.setAll(data);

            series.appear(1000, 100);

        }); // end am5.ready()

    </script>

    <!-- HTML -->
    <div id="chartdiv"></div>

<?php else: ?>

<div class="row justify-content-center">
    <h1 class="text-center my-5">Prueba técnica – Full Stack PHP</h1>
    <p class="text-center"><a class="btn btn-primary mx-2" href="login.php">Iniciar sesión</a> <a class="mx-2 btn btn-secondary" href="signup.php">Registrate</a></p>

</div>


<?php endif; ?>


<?php require 'partials/footer.php' ?>

