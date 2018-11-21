<?php

namespace App\Forms\User;

use App\Models\City;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'label' => 'Nome',
                'rules' => 'required|string'
            ])
            ->add('email', Field::EMAIL, [
                'label' => 'Email',
                'rules' => 'required|email|unique:users'
            ])
            ->add('cpf', Field::TEXT, [
                'label' => 'CPF',
                'rules' => 'required|unique:users'
            ])
            ->add('password', 'repeated', [
                'type' => 'password',
                'second_name' => 'password_confirmation',
                'first_options' => [
                    'label' => 'Senha'
                ],
                'second_options' => [
                    'label' => 'Confirmação de senha'
                ],
                'rules' => $this->getMethod() === 'PUT' ? 'string' : 'required|string'
            ])
            ->add('birth_date', Field::DATE, [
                'label' => 'Data de Nascimento',
                'rules' => 'required'
            ])
            ->add('rg', Field::TEXT, [
                'label' => 'Documento de Identidade',
                'rules' => 'required|string'
            ])
            ->add('rg_issuer', Field::TEXT, [
                'label' => 'Emissor do Documento de Identidade',
                'rules' => 'required|string'
            ])
            ->add('gender', Field::SELECT, [
                'label' => 'Gênero',
                'choices' => [
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                    'O' => 'Outro',
                    'I' => 'Indefinido'
                ],
                'empty_value' => 'Selecione um gênero'
            ])
            ->add('marital_status', Field::TEXT, [
                'label' => 'Estado Civil',
                'rules' => 'required|string'
            ])
            ->add('note', Field::TEXTAREA, [
                'label' => 'Observações',
                'rules' => 'string'
            ])
            ->add('postcode', Field::TEXT, [
                'label' => 'CEP',
                'rules' => 'required|string'
            ])
            ->add('street', Field::TEXT, [
                'label' => 'Rua',
                'rules' => 'required|string'
            ])
            ->add('number', Field::TEXT, [
                'label' => 'Número',
                'rules' => 'required|string'
            ])
            ->add('neighborhood', Field::TEXT, [
                'label' => 'Bairro',
                'rules' => 'required|string'
            ])
            ->add('complement', Field::TEXT, [
                'label' => 'Complemento',
                'rules' => 'string'
            ])
            ->add('city', Field::TEXT, [
                'label' => 'Cidade',
                'rules' => 'required|string'
            ])
            ->add('uf', Field::TEXT, [
                'label' => 'UF',
                'rules' => 'required|string'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => 'Salvar'
            ]);
    }
}