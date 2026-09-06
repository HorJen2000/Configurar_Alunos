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

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    $linhas = array();

    $cabecalho = fgets($arqAluno);

    $linhas[] = $cabecalho;

    while (!feof($arqAluno)) {

        $linha = fgets($arqAluno);

        if ($linha != "") {

            $dados = explode(";", trim($linha));

            if ($dados[0] != $matricula) {

                $linhas[] = $linha;
            }
        }
    }

    fclose($arqAluno);

    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao abrir arquivo");

    foreach ($linhas as $linha) {

        fwrite($arqAluno, $linha);
    }

    fclose($arqAluno);

    $msg = "Aluno excluído com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Aluno</title>
</head>
<body>
    <h1>Exclusão de Aluno</h1>
    <p><?php echo $msg; ?></p>
</body>
</html>