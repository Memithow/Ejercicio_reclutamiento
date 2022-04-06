<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['color'])) {
    $sql = "INSERT INTO users (email, password, color) VALUES (:email, :password, :color)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':color', $_POST['color']);

    if ($stmt->execute()) {
        header("Location: /index.php");
    }
  }
?>

<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

<h1 class="text-center">Registro de nuevo usuario</h1>

<div class="row justify-content-center mt-5">
    <div class="col-6">
        <form action="signup.php" method="POST">
            <div class="mb-2">
                <label for="" class="form-label">Email</label>
                <input class="form-control" name="email" type="text" placeholder="Ingresa tu email" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Contraseña</label>
                <input class="form-control" name="password" type="password" placeholder="Ingresa una contraseña" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Color</label>
                <select class="form-control" name="color" placeholder="Seleccione un color">
                <option value="Rojo">Rojo</option>
                <option value="Verde">Verde</option>
                <option value="Azul">Azul</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3">Enviar</button> <span>o <a href="login.php" class="fw-bolder">Iniciar sesión</a></span>
            </div>
        </form>
    </div>
</div>

<?php require 'partials/footer.php' ?>

