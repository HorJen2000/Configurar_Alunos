<?php
$msg = "";
$tabelaAlunos = "";

if (!file_exists("alunos.txt")) {
    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao criar o arquivo");
    $linha = "nome;matricula;email\n";
    fwrite($arqAluno, $linha);
    fclose($arqAluno);
} 

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo");

    fgets($arqAluno);

    while (!feof($arqAluno)) {

        $linha = fgets($arqAluno);

        if ($linha != "") {
            $dados = explode(";", trim($linha));
            
            $matricula = $dados[0];
            $nome = $dados[1];
            $email = $dados[2];
            
           $tabelaAlunos .= "<tr>";
           $tabelaAlunos .= "<tr>";
           $tabelaAlunos .= "<td>" . $matricula . "</td>";
           $tabelaAlunos .= "<td>" . $nome . "</td>";
           $tabelaAlunos .= "<td>" . $email . "</td>";

           $tabelaAlunos .= "<td>";

           $tabelaAlunos .= "<a href='MostrarAlterado.php?matricula=" .
                $matricula . "'>";

           $tabelaAlunos .= "<button>Alterar</button>";

           $tabelaAlunos .= "</a>";

           $tabelaAlunos .= " ";

           $tabelaAlunos .= "<a href='mostrarExcluido.php?matricula=" .
                $matricula . "'>";

           $tabelaAlunos .= "<button>Excluir</button>";

           $tabelaAlunos .= "</a>";

           $tabelaAlunos .= "</td>";

           $tabelaAlunos .= "</tr>";
        }
    }

    fclose($arqAluno);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
</head>
<body>
    
    <h1>Lista de Alunos</h1>

    <table border="1">

    <tr>
        <th>Matrícula</th>
        <th>Nome</th>
        <th>Email</th>
    </tr>

    <?php echo $tabelaAlunos; ?>

    </table>

    <p><?php echo $msg; ?></p>

</body>
</html>
