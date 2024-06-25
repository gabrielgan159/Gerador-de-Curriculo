<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar e validar entradas conforme necessário
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $data_nascimento = $_POST['data_nascimento'];
    $idade = (int) $_POST['idade'];
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $endereco = filter_var($_POST['endereco'], FILTER_SANITIZE_STRING);
    $cnh = filter_var($_POST['cnh'], FILTER_SANITIZE_STRING);
    $qualidades = filter_var($_POST['qualidades'], FILTER_SANITIZE_STRING);
    $defeitos = filter_var($_POST['defeitos'], FILTER_SANITIZE_STRING);

    // Formatar a data de nascimento para exibir no currículo (dia, mês e ano)
    $data_nascimento_formatada = date('d/m/Y', strtotime($data_nascimento));

    $experiencias = $_POST['experiencia_titulo'];
    $historicos = $_POST['historico_instituicao'];

    // Diretório de upload
    $uploadDir = 'uploads/';
    // Certifique-se de que o diretório de upload existe
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Upload da foto
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed_extensions)) {
            $foto = $uploadDir . uniqid() . '.' . $ext;
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                echo "Erro ao mover o arquivo enviado.";
                exit;
            }
        } else {
            echo "Extensão de arquivo não permitida.";
            exit;
        }
    }

    include 'templates/curriculum-template.php';
}
?>
