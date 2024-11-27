<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome', 
        'preco', 
        'fornecedor_id', 
        'created_at', 
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nome'           => 'required|min_length[3]|max_length[255]',
        'preco'          => 'required|decimal',
        'fornecedor_id'  => 'required|integer',
    ];
    protected $validationMessages   = [
        'nome' => [
            'required'   => 'O nome do produto é obrigatório.',
            'min_length' => 'O nome do produto deve ter pelo menos 3 caracteres.',
        ],
        'preco' => [
            'required' => 'O preço é obrigatório.',
            'decimal'  => 'O preço deve ser um número decimal válido.',
        ],
        'fornecedor_id' => [
            'required' => 'O fornecedor é obrigatório.',
            'integer'  => 'O fornecedor deve ser um número inteiro.',
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getProdutosComFornecedores()
    {
        return $this->select('produtos.*, fornecedores.nome AS fornecedor_nome')
                    ->join('fornecedores', 'fornecedores.id = produtos.fornecedor_id')
                    ->findAll();
    }    

}
