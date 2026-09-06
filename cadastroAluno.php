<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $email = $_POST["email"];
    $msg = "";
    echo "nome: " . $nome . " matricula: " . $matricula . " email: " . $email;
   if (!file_exists("alunos.txt")) {
       $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
       $linha = "nome;matricula;email\n";
       fwrite($arqDisc,$linha);
       fclose($arqDisc);
   }
   $arqDisc = fopen("alunos.txt","a") or die("erro ao criar arquivo");
    $linha = $nome . ";" . $matricula . ";" . $email . "\n";
    fwrite($arqDisc,$linha);
    fclose($arqDisc);
    $msg = "Aluno cadastrado com sucesso!";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: #f0f4f8;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            padding: 32px 28px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 40, 100, 0.08), 0 8px 10px -6px rgba(0, 40, 100, 0.04);
            border-top: 5px solid #1d4ed8;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 1.5rem;
            color: #1e3a8a;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.95rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            background-color: #f8fafc;
            color: #1e293b;
            transition: all 0.2s ease-in-out;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #2563eb;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Remove as setas de input number no Chrome/Firefox */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            appearance: textfield;
            -moz-appearance: textfield;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #1d4ed8;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            margin-top: 8px;
        }

        input[type="submit"]:hover {
            background-color: #1e40af;
        }

        input[type="submit"]:active {
            transform: scale(0.99);
        }

        .alert-success {
            margin-top: 18px;
            padding: 12px 16px;
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            font-size: 0.875rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <h1>Secretaria Escolar</h1>
        <p>Preencha os dados do novo estudante</p>
    </div>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Maria da Silva" required>
        </div>

        <div class="form-group">
            <label for="matricula">Matrícula</label>
            <input type="number" id="matricula" name="matricula" placeholder="Ex: 202400123" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Ex: maria.silva@example.com" required>
        </div>

        <input type="submit" value="Cadastrar Aluno">
    </form>

    <?php if (!empty($msg)): ?>
        <div class="alert-success">
            <?php echo htmlspecialchars($msg); ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>