<!DOCTYPE html>
<html>
<head>
    <title>Cursos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    require_once 'Conexao.class.php';
    require_once 'Curso.class.php';

    // Instanciar a classe de conexão
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Verificar se o formulário de curso foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar se é uma operação de inserção ou atualização
        if (isset($_POST['submit']) && $_POST['submit'] === 'Inserir') {
            // Inserção de curso
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];
            $perfil = $_POST['perfil'];

            // Criação do objeto Curso
            $curso = new Curso($codigo, $nome, $perfil);

            // Inserir curso no banco de dados
            $data = array(
                'codigo' => $curso->getCodigo(),
                'nome' => $curso->getNome(),
                'perfil' => $curso->getPerfil()
            );

            $conexao->insert('curso', $data);
        } elseif (isset($_POST['submit']) && $_POST['submit'] === 'Atualizar') {
            // Atualização de curso
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];
            $perfil = $_POST['perfil'];

            // Criação do objeto Curso
            $curso = new Curso($codigo, $nome, $perfil);

            // Atualizar curso no banco de dados
            $data = array(
                'nome' => $curso->getNome(),
                'perfil' => $curso->getPerfil()
            );

            $conexao->update('curso', $data, 'codigo', $codigo);
        }
    }

    // Verificar se a requisição é para exclusão de um curso
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $codigo = $_GET['codigo'];
        $conexao->delete('curso', 'codigo', $codigo);
    }

    // Buscar todos os cursos do banco de dados
    $cursos = $conexao->selectAll('curso');
    ?>

    <div class="container">
        <h2>Gerenciamento de Cursos</h2>
        <form action="curso.php" method="post">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <textarea class="form-control" id="perfil" name="perfil" rows="3" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Inserir">
            <input type="submit" class="btn btn-primary" name="submit" value="Atualizar">
            <input type="reset" class="btn btn-default" value="Limpar">
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cursos as $curso) {
                    echo '<tr>';
                    echo '<td>' . $curso['codigo'] . '</td>';
                    echo '<td>' . $curso['nome'] . '</td>';
                    echo '<td>' . $curso['perfil'] . '</td>';
                    echo '<td>
                            <a href="curso.php?action=edit&codigo=' . $curso['codigo'] . '" class="btn btn-primary btn-sm">Editar</a>
                            <a href="curso.php?action=delete&codigo=' . $curso['codigo'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza de que deseja excluir o curso?\')">Excluir</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Preencher o formulário com os dados do curso selecionado para edição
        <?php
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            $codigo = $_GET['codigo'];
            $curso = $conexao->select('curso', 'codigo', $codigo);

            echo '$("#codigo").val("' . $curso['codigo'] . '");';
            echo '$("#nome").val("' . $curso['nome'] . '");';
            echo '$("#perfil").val("' . $curso['perfil'] . '");';
            echo '$("input[name=\'submit\']").val("Atualizar");';
        }
        ?>
    </script>
</body>
</html>