<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorModel extends Model
{
    protected $table            = 'fornecedores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome', 
        'cnpj', 
        'email', 
        'telefone', 
        'cep', 
        'logradouro', 
        'numero', 
        'complemento', 
        'bairro', 
        'cidade', 
        'estado', 
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
        'nome'      => 'required|min_length[3]|max_length[255]',
        'cnpj'      => 'required|exact_length[18]|is_unique[fornecedores.cnpj]',
        'email'     => 'required|valid_email',
        'telefone'  => 'required|min_length[10]|max_length[20]',
        'cep'       => 'required|exact_length[9]',
        'logradouro'=> 'required|min_length[3]|max_length[255]',
        'numero'    => 'required|min_length[1]|max_length[20]',
        'bairro'    => 'required|min_length[3]|max_length[255]',
        'cidade'    => 'required|min_length[3]|max_length[255]',
        'estado'    => 'required|exact_length[2]',
    ];
    protected $validationMessages   = [
        'nome' => [
            'required' => 'O nome do fornecedor é obrigatório.',
        ],
        'cnpj' => [
            'required'   => 'O CNPJ é obrigatório.',
            'exact_length'=> 'O CNPJ deve ter 18 caracteres.',
            'is_unique'  => 'Este CNPJ já está cadastrado.',
        ],
        'email' => [
            'required'   => 'O e-mail é obrigatório.',
            'valid_email'=> 'O e-mail fornecido não é válido.',
        ],
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

    public function setValidationRule($field, $rule)
    {
        $this->validationRules[$field] = $rule;
    }

}
