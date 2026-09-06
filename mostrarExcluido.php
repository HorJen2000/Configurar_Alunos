<?php

$conteudo = "";

if (!file_exists("alunos.txt")) {
    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao criar arquivo");
    $linha = "matricula;nome;email\n";
    fwrite($arqAluno, $linha);
    fclose($arqAluno);
}

$matriculaProcurada = $_GET["matricula"];

$matricula = "";
$nome = "";
$email = "";

$arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

fgets($arqAluno);

while (!feof($arqAluno)) {

    $linha = fgets($arqAluno);

    if ($linha != "") {

        $dados = explode(";", trim($linha));

        if ($dados[0] == $matriculaProcurada) {

            $matricula = $dados[0];
            $nome = $dados[1];
            $email = $dados[2];

            break;
        }
    }
}

fclose($arqAluno);

if ($matricula == "") {

    $conteudo = "
        <p>Aluno não encontrado.</p>
        <a href='listagemAlunos.php'>Voltar</a>
    ";

} else {

    $conteudo = "
        <p><strong>Matrícula:</strong> $matricula</p>

        <p><strong>Nome:</strong> $nome</p>

        <p><strong>Email:</strong> $email</p>

        <h3>Deseja realmente excluir este aluno?</h3>

        <form action='exclusãoAluno.php' method='POST'>

            <input type='hidden'
                   name='matricula'
                   value='$matricula'>

            <input type='submit'
                   value='Confirmar Exclusão'>

        </form>

        <br>

        <a href='listagemAlunos.php'>
            Cancelar
        </a>
    ";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Aluno</title>
</head>
<body>
    <h1>Excluir Aluno</h1>
    <p><?php echo $conteudo; ?></p>
</body>
</html>