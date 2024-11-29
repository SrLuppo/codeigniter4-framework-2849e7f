<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Fornecedores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Fornecedores</h2>
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#modal-novo-fornecedor" onclick="$('#action').val('novo');" >Novo Fornecedor</button>

        <!-- Modal Cadastro de Fornecedor -->
        <div class="modal fade" id="modal-novo-fornecedor" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="" method="post" id="form-novo-fornecedor">  
                        <input type="hidden" name="action" id="action" value=""> 
                        <input type="hidden" name="fornecedor-id" id="fornecedor-id" value="">           
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Fornecedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fornecedor-nome">Nome</label>
                                    <input type="text" class="form-control" id="fornecedor-nome" name="nome" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fornecedor-cnpj">CNPJ</label>
                                    <input type="text" class="form-control" id="fornecedor-cnpj" name="cnpj" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fornecedor-email">E-mail</label>
                                    <input type="email" class="form-control" id="fornecedor-email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fornecedor-telefone">Telefone</label>
                                    <input type="text" class="form-control" id="fornecedor-telefone" name="telefone" required>
                                </div>
                            </div>
                            <h5>Endereço</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fornecedor-cep">CEP</label>
                                    <input type="text" class="form-control" id="fornecedor-cep" name="cep" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="fornecedor-logradouro">Logradouro</label>
                                    <input type="text" class="form-control" id="fornecedor-logradouro" name="logradouro" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="fornecedor-numero">Número</label>
                                    <input type="text" class="form-control" id="fornecedor-numero" name="numero" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fornecedor-complemento">Complemento</label>
                                    <input type="text" class="form-control" id="fornecedor-complemento" name="complemento">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fornecedor-bairro">Bairro</label>
                                    <input type="text" class="form-control" id="fornecedor-bairro" name="bairro" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fornecedor-cidade">Cidade</label>
                                    <input type="text" class="form-control" id="fornecedor-cidade" name="cidade" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="fornecedor-estado">Estado</label>
                                    <input type="text" class="form-control" id="fornecedor-estado" name="estado" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <?php if (session()->has('alert')): ?>
            <?php 
            $mensagens = [
                'successCreate' => ['Fornecedor adicionado com sucesso!', 'success'],
                'successEdit'   => ['Fornecedor atualizado com sucesso!', 'info'],
                'successDelete' => ['Fornecedor excluído com sucesso!', 'danger'],
                'error'         => ['Ocorreu um erro.', 'warning']
            ];
            $alert = session('alert') ?? 'error';
            ?>
            <div class="alert alert-<?= $mensagens[$alert][1] ?>">
                <?= $mensagens[$alert][0] ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Contato</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <tr>
                        <td><?= htmlspecialchars($fornecedor['nome']) ?></td>
                        <td><?= htmlspecialchars($fornecedor['cnpj']) ?></td>
                        <td>
                            <?= htmlspecialchars($fornecedor['email']) ?><br>
                            <?= htmlspecialchars($fornecedor['telefone']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($fornecedor['logradouro']) ?>, <?= htmlspecialchars($fornecedor['numero']) ?><br>
                            <?= htmlspecialchars($fornecedor['bairro']) ?>, <?= htmlspecialchars($fornecedor['cidade']) ?> - <?= htmlspecialchars($fornecedor['estado']) ?><br>
                            CEP: <?= htmlspecialchars($fornecedor['cep']) ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" 
                                    onclick="editarFornecedor(<?= htmlspecialchars(json_encode($fornecedor)) ?>)">
                                Editar
                            </button>
                            <form action="<?= base_url('fornecedores/excluir/'.$fornecedor['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>    

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script>
        // Máscaras de Entrada
        $('#fornecedor-cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('#fornecedor-telefone').mask('(00) 00000-0000');
        $('#fornecedor-cep').mask('00000-000');

        // Consulta de CEP
        $('#fornecedor-cep').on('blur', function() {
            const cep = $(this).val().replace(/\D/g, '');

            if (cep) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(dados) {
                    if (!dados.erro) {
                        $('#fornecedor-logradouro').val(dados.logradouro);
                        $('#fornecedor-bairro').val(dados.bairro);
                        $('#fornecedor-cidade').val(dados.localidade);
                        $('#fornecedor-estado').val(dados.uf);
                    } else {
                        alert('CEP não encontrado!');
                    }
                }).fail(function() {
                    alert('Erro ao consultar o CEP!');
                });
            }
        });
    </script>
    <script>
    // Editar fornecedor
    function editarFornecedor(fornecedor) {   

        //fornecedor-id
        $("#fornecedor-id").val(fornecedor.id);

        $("#action").val("editar");
        
        // Preenche o modal com os dados do fornecedor
        $('#modal-novo-fornecedor').modal('show');

        $('#form-novo-fornecedor').attr('action', '/fornecedores/cadastrar/' + fornecedor.id);

        $('#fornecedor-nome').val(fornecedor.nome);
        $('#fornecedor-cnpj').val(fornecedor.cnpj);
        $('#fornecedor-email').val(fornecedor.email);
        $('#fornecedor-telefone').val(fornecedor.telefone);
        $('#fornecedor-cep').val(fornecedor.cep);
        $('#fornecedor-logradouro').val(fornecedor.logradouro);
        $('#fornecedor-numero').val(fornecedor.numero);
        $('#fornecedor-complemento').val(fornecedor.complemento);
        $('#fornecedor-bairro').val(fornecedor.bairro);
        $('#fornecedor-cidade').val(fornecedor.cidade);
        $('#fornecedor-estado').val(fornecedor.estado);
    }

    $('#form-novo-fornecedor').on('submit', function(e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário

        const actionUrl = $(this).attr('action'); 
        const formData = $(this).serialize(); 

        $.ajax({
            url: ($("#action").val()=='novo'?'/fornecedores/cadastrar':'/fornecedores/editar/'+ document.getElementById('fornecedor-id').value),
            type: 'POST',
            data: formData,
            success: function(response) {
                console.table(response);
                if (response.status === 'success') {
                    $('#modal-novo-fornecedor').modal('hide');
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message || 'Erro ao salvar');
                }
            },
            error: function() {
                alert('Erro ao enviar os dados!');
                console.console.log(response);                
            }
        });
    });
// teste outra maneira de castro
function prepararDados(ProdutoId, Nome, Valor, Fornecedor) {
            document.getElementById('modal-editar-produto-ProdutoId').value = ProdutoId;
            document.getElementById('modal-editar-produto-Nome').value = Nome;
            document.getElementById('modal-editar-produto-Valor').value = Valor;
            document.getElementById('modal-editar-produto-Fornecedor').value = Fornecedor;

            $('#modal-editar-produto').modal('show');
        }
        function enviarRequisicao(url, method, data, successCallback, errorCallback) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                success: successCallback,
                error: function(xhr) {
                    if (errorCallback) {
                        errorCallback(xhr);
                    } else {
                        alert(xhr.responseText || 'Erro na requisição!');
                    }
                }
            });
        }    
    </script> 

</body>
</html>
