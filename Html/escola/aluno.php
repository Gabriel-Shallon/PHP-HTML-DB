<!DOCTYPE html>
<html>
<head>
    <title>Alunos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    require_once 'Conexao.class.php';
    require_once 'Aluno.class.php';
    require_once 'Curso.class.php';

    function getStatusColor($status) {
        switch ($status) {
            case 'matriculado':
                return 'success';
            case 'cancelado':
                return 'danger';
            case 'trancado':
                return 'warning';
            default:
                return '';
        }
    }

    // Instanciar a classe de conexão
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Verificar se o formulário de aluno foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar se é uma operação de inserção ou atualização
        if (isset($_POST['submit']) && $_POST['submit'] === 'Inserir') {
            // Inserção de aluno
            $matricula = $_POST['matricula'];
            $nome = $_POST['nome'];
            $datadenascimento = $_POST['datadenascimento'];
            $datadematricula = $_POST['datadematricula'];
            $status = $_POST['status'];
            $curso = $_POST['curso'];

            // Criação do objeto Aluno
            $aluno = new Aluno($matricula, $nome, $datadenascimento, $datadematricula, $status, $curso);

            // Inserir aluno no banco de dados
            $data = array(
                'matricula' => $aluno->getMatricula(),
                'nome' => $aluno->getNome(),
                'datadenascimento' => $aluno->getDatadenascimento(),
                'datadematricula' => $aluno->getDatadematricula(),
                'status' => $aluno->getStatus(),
                'curso' => $aluno->getCurso()
            );
            $conexao->insert('aluno', $data);

        } elseif (isset($_POST['submit']) && $_POST['submit'] === 'Atualizar') {
            // Atualização de aluno
            $matricula = $_POST['matricula'];
            $nome = $_POST['nome'];
            $datadenascimento = $_POST['datadenascimento'];
            $datadematricula = $_POST['datadematricula'];
            $status = $_POST['status'];
            $curso = $_POST['curso'];

            // Criação do objeto Aluno
            $aluno = new Aluno($matricula, $nome, $datadenascimento, $datadematricula, $status, $curso);

            // Atualizar aluno no banco de dados
            $data = array(
                'nome' => $aluno->getNome(),
                'datadenascimento' => $aluno->getDatadenascimento(),
                'datadematricula' => $aluno->getDatadematricula(),
                'status' => $aluno->getStatus(),
                'curso' => $aluno->getCurso()
            );

            $conexao->update('aluno', $data, 'matricula', $matricula);
        }
    }

    // Verificar se a requisição é para exclusão de um aluno
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $matricula = $_GET['matricula'];
        $conexao->delete('aluno', 'matricula', $matricula);
    }

    // Buscar todos os alunos e cursos do banco de dados
    $alunos = $conexao->selectAll('aluno');
    $cursos = $conexao->selectAll('curso');
    ?>

    <div class="container">
        <h2>Gerenciamento de Alunos</h2>
        <form action="aluno.php" method="post">
            <div class="form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="datadenascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="datadenascimento" name="datadenascimento" required>
            </div>
            <div class="form-group">
                <label for="datadematricula">Data de Matrícula:</label>
                <input type="date" class="form-control" id="datadematricula" name="datadematricula" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="matriculado">Matriculado</option>
                    <option value="cancelado">Cancelado</option>
                    <option value="trancado">Trancado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="curso">Curso:</label>
                <select class="form-control" id="curso" name="curso" required>
                    <?php
                    foreach ($cursos as $curso) {
                        echo '<option value="' . $curso['codigo'] . '">' . $curso['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <?php
        // Verificar se é uma operação de inserção ou atualização
        // if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            // Modo de edição
            // echo '<input type="submit" class="btn btn-primary" name="submit" value="Atualizar">';
        // } else {
            // Modo de inserção
            echo '<input type="submit" class="btn btn-primary" name="submit" value="Inserir">';
        // }
        ?>
            <input type="reset" class="btn btn-default" value="Limpar">
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Data de Matrícula</th>
                    <th>Status</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($alunos as $aluno) {
                    echo '<tr>';
                    echo '<td>' . $aluno['matricula'] . '</td>';
                    echo '<td>' . $aluno['nome'] . '</td>';
                    echo '<td>' . $aluno['datadenascimento'] . '</td>';
                    echo '<td>' . $aluno['datadematricula'] . '</td>';
                    echo '<td><span class="label label-' . getStatusColor($aluno['status']) . '">' . $aluno['status'] . '</span></td>';

                    // echo '<td>';
                    // // Definir a cor do status com base no valor
                    // if ($aluno['status'] === 'matriculado') {
                    //     echo '<span class="label label-success">Matriculado</span>';
                    // } elseif ($aluno['status'] === 'cancelado') {
                    //     echo '<span class="label label-danger">Cancelado</span>';
                    // } elseif ($aluno['status'] === 'trancado') {
                    //     echo '<span class="label label-warning">Trancado</span>';
                    // }                    
                    // echo '</td>';
                    
                    echo '<td>' . $aluno['curso'] . '</td>';
                    echo '<td>';
                    echo '<a href="aluno.php?action=edit&matricula=' . $aluno['matricula'] . '" class="btn btn-primary btn-xs">Editar</a> ';
                    echo '<a href="aluno.php?action=delete&matricula=' . $aluno['matricula'] . '" class="btn btn-danger btn-xs" onclick="return confirm(\'Tem certeza que deseja excluir?\')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script>
        // Preencher o formulário com os dados do aluno selecionado para edição
        <?php
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            $matricula = $_GET['matricula'];
            $aluno = $conexao->select('aluno', 'matricula', $matricula);

            echo '$("#matricula").val("' . $aluno['matricula'] . '");';
            echo '$("#nome").val("' . $aluno['nome'] . '");';
            echo '$("#datadenascimento").val("' . $aluno['datadenascimento'] . '");';
            echo '$("#datadematricula").val("' . $aluno['datadematricula'] . '");';
            echo '$("#status").val("' . $aluno['status'] . '");';
            echo '$("#curso").val("' . $aluno['curso'] . '");';
            echo '$("input:submit").val("Atualizar");';
        }
        ?>
    </script>
</body>
</html>
