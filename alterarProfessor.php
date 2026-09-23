<?php
$msg = "";

if (!file_exists("professor.txt")) {
    $arqProfessor = fopen("professor.txt", "w") or die("Não foi possível criar o arquivo");
    $linha = "matricula;nome;cpf;endereco\n";
    fwrite($arqProfessor, $linha);
    fclose($arqProfessor);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];

    $arqProfessor = fopen("professor.txt", "r") or die("Não foi possível abrir o arquivo");
    $linhas = [];
    while (!feof($arqProfessor)) {
        $linha = fgets($arqProfessor);
        if (trim($linha) != "") {
            $dados = explode(";", $linha);
            if ($dados[0] == $matricula) {
                $linha = "$matricula;$nome;$cpf;$endereco\n";
            }
            $linhas[] = $linha;
        }
    }
    fclose($arqProfessor);

    $arqProfessor = fopen("professor.txt", "w") or die("Não foi possível abrir o arquivo");
    foreach ($linhas as $linha) {
        fwrite($arqProfessor, $linha);
    }
    fclose($arqProfessor);

    $msg = "Professor alterado com sucesso!";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Professor</title>
</head>
<body>
    <h1>Alterar Professor</h1>
    <form method="POST" action="">
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <input type="submit" value="Alterar">
    </form>

    <?php if ($msg != ""): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>


</body>
</html>