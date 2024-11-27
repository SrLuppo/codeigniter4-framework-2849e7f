<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProdutosController extends BaseController
{
    public function index()
    {
        $produtoModel = new \App\Models\ProdutoModel();
        $produtos = $produtoModel->getProdutosComFornecedores();    
        
        $fornecedores = (new \App\Models\FornecedorModel())->findAll();
   
        
        return view('Produtos', ['produtos' => $produtos, 'fornecedores' => $fornecedores]);
    }
    public function cadastrar()
    {
        $produtoModel = new \App\Models\ProdutoModel();
    
        $dados = [
            'nome' => $this->request->getPost('nome'),
            'preco' => $this->request->getPost('preco'),
            'fornecedor_id' => $this->request->getPost('fornecedor_id'),
        ];
    
        if ($produtoModel->insert($dados)) {
            session()->setFlashdata('alert', 'successCreate');
        } else {
            session()->setFlashdata('alert', 'errorCreate');
        }
    
        return redirect()->to('/produtos');
    }
    public function editar()
    {
        $produtoModel = new \App\Models\ProdutoModel();
    
        $dados = [
            'id' => $this->request->getPost('ProdutoId'),
            'nome' => $this->request->getPost('Nome'),
            'preco' => $this->request->getPost('Valor'),
            'fornecedor_id' => $this->request->getPost('fornecedor_id'),
        ];
    
        if ($produtoModel->update($dados['id'], $dados)) {
            session()->setFlashdata('alert', 'successEdit');
        } else {
            session()->setFlashdata('alert', 'errorEdit');
        }
    
        return redirect()->to('/produtos');
    }

    public function excluir($id)
    {   
        $produtoModel = new \App\Models\ProdutoModel();        

        $data['post'] = $produtoModel->where('id', $id)->delete();

        if ($data['post'] == true) {
            session()->setFlashdata('alert', 'successDelete');
        } else {
            session()->setFlashdata('alert', 'errorDelete');
        }
       
        return redirect()->to('/produtos');

    }
    
}