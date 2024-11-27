<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FornecedorModel;
use CodeIgniter\HTTP\ResponseInterface; // NOTE : inclui está linha


class FornecedoresController extends BaseController
{
    protected $fornecedorModel;

    public function __construct()
    {
        $this->fornecedorModel = new FornecedorModel();
    }

    public function index()
    {
        $fornecedores = $this->fornecedorModel->findAll();

        return view('Fornecedores', ['fornecedores' => $fornecedores]);
    }
    public function t()
    {
        $fornecedores = $this->fornecedorModel->findAll();

        return view('Fornecedores', ['fornecedores' => $fornecedores]);
    }
    public function cadastrar()
    {
        return redirect()->to('/fornecedores');

        try {
            echo dividir(5,2)."<br/>";
 
        // Validação e cadastro do fornecedor
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $request->input('nome');
        $fornecedor->cnpj = $request->input('cnpj');
        $fornecedor->email = $request->input('email');
        $fornecedor->telefone = $request->input('telefone');
        $fornecedor->cep = $request->input('cep');
        $fornecedor->logradouro = $request->input('logradouro');
        $fornecedor->numero = $request->input('numero');
        $fornecedor->complemento = $request->input('complemento');
        $fornecedor->bairro = $request->input('bairro');
        $fornecedor->cidade = $request->input('cidade');
        $fornecedor->estado = $request->input('estado');
        $fornecedor->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Fornecedor adicionado com sucesso!',
            'fornecedor' => $fornecedor
        ]);
        } catch (Exception $e) {
            return response()->json([
                
                'message' => $e->getMessage(),
                
            ]);
        }
    }
    
    
    

    public function editar($id)
    {
        if ($this->request->getMethod() === 'post') {
            $dados = $this->request->getPost();
            $dados['id'] = $id; 

            if ($this->fornecedorModel->save($dados)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Fornecedor atualizado com sucesso!',
                    'fornecedor' => $this->fornecedorModel->find($id)
                ]);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erro ao atualizar fornecedor!'
            ]);
        }
    }

    public function excluir($id)
    {
        if ($this->fornecedorModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Fornecedor excluído com sucesso!',
                'id' => $id
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Erro ao excluir fornecedor!'
        ]);
    }
}
