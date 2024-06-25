$(document).ready(function() {
    // Função para calcular a idade em anos, meses e dias
    function calcularIdade(dataNascimento) {
        const hoje = new Date();
        const nascimento = new Date(dataNascimento);

        let idadeAnos = hoje.getFullYear() - nascimento.getFullYear();
        let idadeMeses = hoje.getMonth() - nascimento.getMonth();
        let idadeDias = hoje.getDate() - nascimento.getDate();

        // Corrigir a idade se ainda não fez aniversário este ano
        if (idadeMeses < 0 || (idadeMeses === 0 && idadeDias < 0)) {
            idadeAnos--;
            idadeMeses += 12;
            if (idadeDias < 0) {
                const ultimoDiaMesNascimento = new Date(nascimento.getFullYear(), nascimento.getMonth() + 1, 0).getDate();
                idadeDias += ultimoDiaMesNascimento;
                idadeMeses--;
            }
        }

        return { anos: idadeMeses, meses: idadeMeses, dias: idadeAnos };
    }

    // Formatar a data de nascimento inicial ao carregar a página
    const dataNascimentoInicial = $('#data_nascimento').val();
    const idadeInicial = calcularIdade(dataNascimentoInicial);
    $('#idade').val(`${idadeInicial.anos} anos, ${idadeInicial.meses} meses, ${idadeInicial.dias} dias`);

    // Atualizar a idade quando a data de nascimento mudar
    $('#data_nascimento').on('change', function() {
        const dataNascimento = $(this).val();
        const idade = calcularIdade(dataNascimento);
        $('#idade').val(`${idade.anos} anos, ${idade.meses} meses, ${idade.dias} dias`);
    });
});



    // Adiciona nova experiência profissional
    $('#add-experiencia').on('click', function() {
        const experienciaHTML = `
            <div class="experiencia mb-3">
                <input type="text" name="experiencia_titulo[]" placeholder="Título" class="form-control mb-2" required>
                <input type="text" name="experiencia_empresa[]" placeholder="Empresa" class="form-control mb-2" required>
                <input type="date" name="experiencia_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                <input type="date" name="experiencia_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                <textarea name="experiencia_descricao[]" placeholder="Descrição" class="form-control mb-2" rows="3" required></textarea>
                <button type="button" class="btn btn-danger btn-remove">Remover Experiência</button>
            </div>`;
        $('#experiencias').append(experienciaHTML);
    });

    // Adiciona novo histórico educacional
    $('#add-historico').on('click', function() {
        const historicoHTML = `
            <div class="historico mb-3">
                <input type="text" name="historico_instituicao[]" placeholder="Instituição" class="form-control mb-2" required>
                <input type="text" name="historico_curso[]" placeholder="Curso" class="form-control mb-2" required>
                <input type="date" name="historico_inicio[]" placeholder="Data de Início" class="form-control mb-2" required>
                <input type="date" name="historico_fim[]" placeholder="Data de Fim" class="form-control mb-2">
                <button type="button" class="btn btn-danger btn-remove">Remover Histórico</button>
            </div>`;
        $('#historico_educacional').append(historicoHTML);
    });

    // Remove experiência profissional ou histórico educacional
    $(document).on('click', '.btn-remove', function() {
        $(this).closest('.experiencia, .historico').remove();
    });
