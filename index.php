<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-remove {
            margin-top: 5px;
        }
        .periodo {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Gerador de Currículos</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="mb-4">Gerador de Currículos</h1>
        <form id="curriculo-form" action="process.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento:</label>
                        <input type="text" id="data_nascimento" name="data_nascimento" class="form-control" placeholder="dd-mm-aaaa" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="idade">Idade:</label>
                        <input type="number" id="idade" name="idade" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cnh">CNH:</label>
                <input type="text" id="cnh" name="cnh" class="form-control">
            </div>
            <div class="form-group">
                <label for="qualidades">Qualidades:</label>
                <textarea id="qualidades" name="qualidades" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="defeitos">Defeitos:</label>
                <textarea id="defeitos" name="defeitos" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Experiências Profissionais:</label>
                <div id="experiencias">
                    <div class="experiencia mb-3">
                        <input type="text" name="experiencia_titulo[]" placeholder="Título" class="form-control mb-2" required>
                        <input type="text" name="experiencia_empresa[]" placeholder="Empresa" class="form-control mb-2" required>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="experiencia_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                            </div>
                            <div class="col">
                                <input type="date" name="experiencia_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                            </div>
                        </div>
                        <textarea name="experiencia_descricao[]" placeholder="Descrição" class="form-control mb-2" rows="3" required></textarea>
                        <button type="button" class="btn btn-danger btn-remove">Remover Experiência</button>
                    </div>
                </div>
                <button type="button" id="add-experiencia" class="btn btn-primary">Adicionar Experiência</button>
            </div>
            <div class="form-group">
                <label>Histórico Educacional:</label>
                <div id="historico_educacional">
                    <div class="historico mb-3">
                        <input type="text" name="historico_instituicao[]" placeholder="Instituição" class="form-control mb-2" required>
                        <input type="text" name="historico_curso[]" placeholder="Curso" class="form-control mb-2" required>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="historico_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                            </div>
                            <div class="col">
                                <input type="date" name="historico_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-remove">Remover Histórico</button>
                    </div>
                </div>
                <button type="button" id="add-historico" class="btn btn-primary">Adicionar Histórico</button>
            </div>
            <button type="submit" class="btn btn-success">Gerar Currículo</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data_nascimento').on('change', function() {
                const birthDateString = $(this).val();
                const [dia, mes, ano] = birthDateString.split('-');
                const birthDate = new Date(ano, mes - 1, dia);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#idade').val(age);
            });

            $('#add-experiencia').click(function() {
                $('#experiencias').append(`
                    <div class="experiencia mb-3">
                        <input type="text" name="experiencia_titulo[]" placeholder="Título" class="form-control mb-2" required>
                        <input type="text" name="experiencia_empresa[]" placeholder="Empresa" class="form-control mb-2" required>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="experiencia_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                            </div>
                            <div class="col">
                                <input type="date" name="experiencia_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                            </div>
                        </div>
                        <textarea name="experiencia_descricao[]" placeholder="Descrição" class="form-control mb-2" rows="3" required></textarea>
                        <button type="button" class="btn btn-danger btn-remove">Remover Experiência</button>
                    </div>
                `);
            });

            $('#add-historico').click(function() {
                $('#historico_educacional').append(`
                    <div class="historico mb-3">
                        <input type="text" name="historico_instituicao[]" placeholder="Instituição" class="form-control mb-2" required>
                        <input type="text" name="historico_curso[]" placeholder="Curso" class="form-control mb-2" required>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="historico_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                            </div>
                            <div class="col">
                                <input type="date" name="historico_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-remove">Remover Histórico</button>
                    </div>
                `);
            });

            $(document).on('click', '.btn-remove', function() {
                $(this).parent().remove();
            });
        });
    </script>
</body>
</html>