<?php 
require 'includes/app.php';
$db = conectarDB();
$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if(!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if(!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if(empty($errores)) {
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '$email';";
        $res = mysqli_query($db, $query);
        if($res->num_rows) {
            $usuario = mysqli_fetch_assoc($res);
            //verificar contraseña
            $auth = password_verify($password, $usuario['password']);
            if($auth) {
                //header('Location: /');
                session_start();
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
            } else {
                $errores[] = "Usuario o contraseña no son correctos";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}
incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="post" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail</label>
                <input name="email" type="email" id="email" placeholder="Tu Email">
                <label for="password">Password</label>
                <input name="password" type="password" id="password" placeholder="Tu Password">
                <input type="submit" class="boton boton-verde" value="Iniciar Sesion">
            </fieldset>
        </form>
    </main>
<?php 
    incluirTemplate('footer'); 
?>