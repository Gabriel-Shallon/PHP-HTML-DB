<?php
    require_once "conexao.class.php";
    require_once "registro.class.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = (isset($_POST['name']) ? $_POST['name'] : null);
    $phone = (isset($_POST['phone']) ? $_POST['phone'] : null);
    $email = (isset($_POST['email']) ? $_POST['email'] : null);

    require_once "conexao.class.php";
    require_once "registro.class.php";

    $registro = new registro(null, $name, $phone, $email);
    $conexao = new conexao();
    $conexao->insert($registro);
}

$conexao = new conexao();
$dados = $conexao->selectALL();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form method='post'>
        <fieldset>
            <legend>Registro de Usuários</legend>
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" required><br />
            <label for="phone">Phone: </label>
            <input type="tel" name="phone" id="phone"></textarea><br />
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required><br />
            <button type="submit">Save</button>
        </fieldset>
</form>
</body>
</html>