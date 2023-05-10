<?php
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : "";
?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <title>Testes HTML</title>
  </head>
 <body>
    <form name="formulario" method="post">
        <h1>Formulario de teste</h1>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">
        <input type="text" name="nome0" id="nome0" value="<?php echo $nome; ?>">
        <input type="hidden" name="acao" value="editar">
        <input type="submit" value="Enviar">
      </form>
      <a href="recebe.php?acao=inserir&nome=Eduardo">Inserir</a>
      <a href="recebe.php?acao=Editar&nome=Eduardo">Editarr</a>
      <a href="recebe.php?=delete&matricula=1">Excluir</a>
      
  </body>
</html>