<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Fornecedores1 extends BaseController
{
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
    
}
