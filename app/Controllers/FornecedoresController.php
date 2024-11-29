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
        try {

        $dados = [
            'nome' => $this->request->getPost('nome'),
            'cnpj' => $this->request->getPost('cnpj'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'cep' => $this->request->getPost('cep'),
            'logradouro' => $this->request->getPost('logradouro'),
            'numero' => $this->request->getPost('numero'),
            'complemento' => $this->request->getPost('complemento'),
            'bairro' => $this->request->getPost('bairro'),
            'cidade' => $this->request->getPost('cidade'),
            'estado' => $this->request->getPost('estado'),
        ];
    
        if ($this->fornecedorModel->insert($dados)) {
            return response()->setJSON([
                'status' => 'success',
                'message' => 'Fornecedor adicionado com sucesso!',
                'fornecedor' => $this->fornecedorModel->findAll()
            ]);
    
        } else {
            return response()->setJSON([
                'error' => $this->fornecedorModel->errors(),
                'message' => 'Não foi possivel cadastrar o Fornecedor! MOTIVO111: ' . implode(', ', $this->fornecedorModel->errors()),                
            ]);
        }    
        return response()->setJSON([
            'status' => 'success',
            'message' => 'Fornecedor adicionado com sucesso!',
            'fornecedor' => $fornecedor 
        ]);

        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage().' teste',]);
        }
    } 
    public function editar()
    {
        try {
            $id = $this->request->getPost('id');
            $dados = [
                'nome'        => $this->request->getPost('nome'),
                'cnpj'        => $this->request->getPost('cnpj'),
                'email'       => $this->request->getPost('email'),
                'telefone'    => $this->request->getPost('telefone'),
                'cep'         => $this->request->getPost('cep'),
                'logradouro'  => $this->request->getPost('logradouro'),
                'numero'      => $this->request->getPost('numero'),
                'complemento' => $this->request->getPost('complemento'),
                'bairro'      => $this->request->getPost('bairro'),
                'cidade'      => $this->request->getPost('cidade'),
                'estado'      => $this->request->getPost('estado'),
            ];
    
            // Atualiza a validação para ignorar o registro atual
            $this->fornecedorModel->setValidationRule('cnpj', "required|exact_length[18]|is_unique[fornecedores.cnpj,id,{$id}]");
    
            // Realiza a atualização
            if ($this->fornecedorModel->update($id, $dados)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Fornecedor editado com sucesso!',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Não foi possível editar o fornecedor!',
                    'errors' => $this->fornecedorModel->errors(),
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Ocorreu um erro: ' . $e->getMessage(),
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
