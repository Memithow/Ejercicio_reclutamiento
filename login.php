<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /index.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /index.php");
    } else {
      $message = 'Credenciales incorrectas.';
    }
  }

?>

<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

<div class="row justify-content-center">
    <h1 class="text-center my-5">Iniciar Sesión</h1>

    <div class="row justify-content-center">
        <div class="col-4">
            <form action="login.php" method="POST" class="m-auto">
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control" name="email" type="text" placeholder="Ingrasa tu email">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label">Contraseña</label>
                    <input class="form-control" name="password" type="password" placeholder="Ingresa tu contraseña">
                </div>
                <div class="text-center">
                    <button type="submit" value="Submit" class="btn btn-primary">Enviar</button> <span>o <a href="signup.php" class="fw-bolder">Registrar nuevo usuario</a></span>
                </div>
            </form>
        </div>
    </div>

</div>


<?php require 'partials/footer.php' ?>