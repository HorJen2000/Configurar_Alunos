<?php

$msg = "";
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
        <form action='alterarAluno.php' method='POST'>

            Matrícula:
            <input type='text'
                   name='matricula'
                   value='$matricula'
                   readonly>

            <br><br>

            Nome:
            <input type='text'
                   name='nome'
                   value='$nome'>

            <br><br>

            Email:
            <input type='text'
                   name='email'
                   value='$email'>

            <br><br>

            <input type='submit'
                   value='Alterar Aluno'>

        </form>

        <br>

        <a href='listagemAlunos.php'>Voltar</a>
    ";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Aluno</title>
</head>
<body>
    
    <h1>Alterar Aluno</h1>

    <p><?php echo $conteudo; ?></p>
    <p><?php echo $msg; ?></p>

</body>
</html>