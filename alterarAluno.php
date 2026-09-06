<?php

$msg = "";

if (!file_exists("alunos.txt")) {
    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao criar arquivo");
    $linha = "matricula;nome;email\n";
    fwrite($arqAluno, $linha);
    fclose($arqAluno);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    $linhas = array();

    $cabecalho = fgets($arqAluno);

    $linhas[] = $cabecalho;

    while (!feof($arqAluno)) {

        $linha = fgets($arqAluno);

        if ($linha != "") {

            $dados = explode(";", trim($linha));

            if ($dados[0] == $matricula) {

                $linha = $matricula . ";" .
                         $nome . ";" .
                         $email . "\n";
            }

            $linhas[] = $linha;
        }
    }

    fclose($arqAluno);

    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao abrir arquivo");

    foreach ($linhas as $linha) {
        fwrite($arqAluno, $linha);
    }

    fclose($arqAluno);

    $msg = "Aluno alterado com sucesso!";
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
    <p><?php echo $msg; ?></p>
</body>
</html>