<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo de <?= htmlspecialchars($nome) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .curriculo {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
        }
        .header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .header h1 {
            margin-bottom: 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #343a40;
        }
        .experiencia, .historico {
            margin-bottom: 15px;
        }
        .experiencia h3, .historico h3 {
            margin-bottom: 5px;
        }
        .button-container {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container curriculo">
        <div class="button-container">
            <button type="button" class="btn btn-primary" onclick="printCurriculum()">Imprimir Currículo</button>
        </div>
        <div class="header">
            <?php if ($foto): ?>
                <img src="<?= htmlspecialchars($foto) ?>" alt="Foto de <?= htmlspecialchars($nome) ?>" class="foto" width="120" height="120">
            <?php endif; ?>
            <div>
                <h1><?= htmlspecialchars($nome) ?></h1>
                <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data_nascimento_formatada); ?></p>
                <p><strong>Idade:</strong> <?php echo htmlspecialchars($idade); ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($telefone) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Endereço:</strong> <?= htmlspecialchars($endereco) ?></p>
                <p><strong>CNH:</strong> <?= htmlspecialchars($cnh) ?></p>
                <p><strong>Qualidades:</strong> <?= nl2br(htmlspecialchars($qualidades)) ?></p>
                <p><strong>Defeitos:</strong> <?= nl2br(htmlspecialchars($defeitos)) ?></p>
            </div>
        </div>
        <div class="section">
            <h2>Experiências Profissionais</h2>
            <?php foreach ($experiencias as $index => $titulo): ?>
                <div class="experiencia">
                    <h3><?= htmlspecialchars($titulo) ?></h3>
                    <p><strong>Empresa:</strong> <?= htmlspecialchars($_POST['experiencia_empresa'][$index]) ?></p>
                    <p><strong>Período:</strong> <?= htmlspecialchars($_POST['experiencia_inicio'][$index]) ?> - <?= htmlspecialchars($_POST['experiencia_fim'][$index]) ?></p>
                    <p><?= nl2br(htmlspecialchars($_POST['experiencia_descricao'][$index])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="section">
            <h2>Histórico Educacional</h2>
            <?php foreach ($historicos as $index => $instituicao): ?>
                <div class="historico">
                    <h3><?= htmlspecialchars($instituicao) ?></h3>
                    <p><strong>Curso:</strong> <?= htmlspecialchars($_POST['historico_curso'][$index]) ?></p>
                    <p><strong>Período:</strong> <?= htmlspecialchars($_POST['historico_inicio'][$index]) ?> - <?= htmlspecialchars($_POST['historico_fim'][$index]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function printCurriculum() {
            var printButton = document.querySelector(".button-container");
            printButton.style.display = "none";
            window.print();
            printButton.style.display = "block";
        }
    </script>
</body>
</html>
