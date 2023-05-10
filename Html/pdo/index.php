<?php
    require_once "Cliente.class.php";
    require_once "Conexao.class.php";
    $conexao = new Conexao();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name  = (isset($_POST['name']) ? $_POST['name'] : null);
        $phone  = (isset($_POST['phone']) ? $_POST['phone'] : null);
        $email  = (isset($_POST['email']) ? $_POST['email'] : null);
        $cliente = new Cliente($name, $email, $phone);
        if (!empty($conexao->select($_POST['id']))){
            $id  = (isset($_POST['id']) ? $_POST['id'] : null);
            $cliente = new Cliente($name, $email, $phone, $id);
            $conexao->update($cliente);
            header("location:index.php");
        }
        else     
            $conexao->insert($cliente);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Exercício Prático</title>
</head>
<body>
    <div class="container mt-1">
		<h1>Formulário de Contato</h1>

        <?php
        if (isset($_GET['id'])){
            $dado = $conexao->select($_GET['id']);
        }
            $id = isset($dado['id']) ? $dado['id'] : "";
            $name = isset($dado['name']) ? $dado['name'] : "";
            $email = isset($dado['email']) ? $dado['email'] : "";
            $phone = isset($dado['phone']) ? $dado['phone'] : "";
        ?>
		<form method="post">
			<div class="form-group">
				<label for="id">ID:</label>
				<input type="text" class="form-control" value="<?php echo $id; ?>" id="id" name="id" readonly>
			</div>
			<div class="form-group">
				<label for="name">Nome:</label>
				<input type="text" class="form-control" value="<?php echo $name; ?>"  id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="phone">Telefone:</label>
				<input type="tel" class="form-control" value="<?php echo $phone; ?>"  id="phone" name="phone" mask="" required>
			</div>
			<div class="form-group">
				<label for="email">E-mail:</label>
				<input type="email" class="form-control" value="<?php echo $email; ?>"  id="email" name="email" required>
			</div>
			<button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

    <div class="container mt-0">
		<table class="table">
			<thead>
				<tr>
                    <th>Ações</th>
					<th>ID</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>

            <?php
                $dados = $conexao->selectAll();
                if(empty($conexao->selectAll()))
                    echo "<tr><td colspan='5'>Vazio</td></tr>";
                else {
                    foreach($dados as $rows){
            ?>
				<tr>
                    <td>
						<a href="index.php?id=<?php echo $rows['id']; ?>" class="btn btn-sm btn-warning">
							<i class="fas fa-edit"></i> Editar
						</a>
						<a href="index.php?id=<?php echo $rows['id']; ?>" class="btn btn-sm btn-danger">
							<i class="fas fa-trash-alt"></i> Excluir
						</a>
					</td>
					<td><?php echo $rows['id']; ?></td>
					<td><?php echo $rows['name']; ?></td>
					<td><?php echo $rows['phone']; ?></td>
					<td><?php echo $rows['email']; ?></td>
				</tr>
                <?php }} ?>
			</tbody>
		</table>
	</div>
</body>
</html>