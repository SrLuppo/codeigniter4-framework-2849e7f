<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Modal de Edição -->
    <div class="modal fade" id="modal-editar-produto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/produtos/editar" method="post" id="form-editar-produto">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="modal-editar-produto-Nome">Nome</label>
                                    <input type="text" class="form-control" id="modal-editar-produto-Nome" name="Nome">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="modal-editar-produto-Valor">Valor</label>
                                    <input type="text" class="form-control" id="modal-editar-produto-Valor" name="Valor">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="modal-editar-produto-Fornecedor">Fornecedor</label>
                                    <select class="form-control" id="modal-editar-produto-Fornecedor" name="fornecedor_id" required>
                                        <option value="">Selecione um fornecedor</option>
                                        <?php foreach ($fornecedores as $fornecedor): ?>
                                            <option value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="modal-editar-produto-ProdutoId" name="ProdutoId">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Adicionar Produto -->
    <div class="modal fade" id="modal-novo-produto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/produtos/cadastrar" method="post" id="form-novo-produto">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="novo-produto-Nome">Nome</label>
                                    <input type="text" class="form-control" id="novo-produto-Nome" name="nome" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="novo-produto-Valor">Valor</label>
                                    <input type="text" class="form-control" id="novo-produto-Valor" name="preco" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="novo-produto-Fornecedor">Fornecedor</label>
                                    <select class="form-control" id="novo-produto-Fornecedor" name="fornecedor_id" required>
                                        <option value="">Selecione um fornecedor</option>
                                        <?php foreach ($fornecedores as $fornecedor): ?>
                                            <option value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Produtos</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-novo-produto">
            Adicionar Produto
        </button>
        <?php if (session()->has('alert')): ?>
            <?php 
            $mensagens = [
                'successCreate' => ['Produto adicionado com sucesso!', 'success'],
                'successEdit'   => ['Produto atualizado com sucesso!', 'info'],
                'successDelete' => ['Produto excluído com sucesso!', 'danger'],
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
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto['nome'] ?></td>
                        <td><?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= $produto['fornecedor_nome'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" 
                                    onclick="prepararDados('<?= $produto['id'] ?>', '<?= $produto['nome'] ?>', '<?= $produto['preco'] ?>', '<?= $fornecedor['id'] ?>')"> 
                                Editar
                            </button>
                            <form action="<?= base_url('produtos/excluir/'.$produto['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este Produto ?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>        
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
        // function excluirProduto(id, nome, preco) {
        //     // Confirmação da exclusão
        //     if (!confirm(`Tem certeza que deseja excluir o produto "${nome}" (R$ ${parseFloat(preco).toFixed(2).replace('.', ',')})?`)) {
        //         return;  // Se o usuário cancelar a exclusão, não faz nada
        //     }

        //     // Requisição AJAX para excluir o produto
        //     $.ajax({
        //         url: `/produtos/excluir/${id}`,  // O ID do produto é passado na URL
        //         method: 'POST', // Método POST
        //         success: function(response) {
        //             if (response.success) {
        //                 alert('Produto excluído com sucesso!');
        //                 window.location.reload(); // Recarrega a página para mostrar a lista atualizada
        //             } else {
        //                 alert(response.message || 'Erro ao excluir o produto.');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             alert('Erro na requisição!');
        //             console.error('Erro:', error); // Log no console para depuração
        //         }
        //     });
        // }

        function carregarTabela() {
            $.ajax({
                url: '/produtos',
                method: 'GET',
                success: function(response) {
                    $('tbody').html('');
                    response.produtos.forEach(produto => {
                        $('tbody').append(`
                            <tr>
                                <td>${produto.nome}</td>
                                <td>${parseFloat(produto.preco).toFixed(2).replace('.', ',')}</td>
                                <td>${produto.fornecedor_nome}</td>
                                <td>
                                    <button class="btn btn-warning" 
                                            onclick="prepararDados('${produto.id}', '${produto.nome}', '${produto.preco}')">Editar</button>
                                    <a href="javascript:void(0)" 
                                    class="btn btn-danger" 
                                    onclick="excluirProduto(${produto.id})">Excluir</a>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function() {
                    alert('Erro ao carregar a tabela!');
                }
            });
        }
    </script>
</body>
</html>
