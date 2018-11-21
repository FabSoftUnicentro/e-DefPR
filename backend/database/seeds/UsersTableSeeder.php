<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Edef Juridico',
            'email' => 'juridico@edefpr.com',
            'password' => 'secret',
            'cpf' => '1318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('juridical-administrative-technician');

        $user = User::create([
            'name' => 'Edef Administrador',
            'email' => 'administrative@edefpr.com',
            'password' => 'secret',
            'cpf' => '2318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerato.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('administrative-technician');

        $user = User::create([
            'name' => 'Edef Assistente Social',
            'email' => 'assistente.social@edefpr.com',
            'password' => 'secret',
            'cpf' => '3318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('social-worker');

        $user = User::create([
            'name' => 'Edef Estagiario Advogado',
            'email' => 'estagiario.advogado@edefpr.com',
            'password' => 'secret',
            'cpf' => '4318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('lawyer-intern');

        $user = User::create([
            'name' => 'Edef Assessor Juridico',
            'email' => 'assessor.juridico@edefpr.com',
            'password' => 'secret',
            'cpf' => '5318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('legal-adviser');

        $user = User::create([
            'name' => 'Edef Estagiario Ensino Medio',
            'email' => 'estagiario.ensinomedio@edefpr.com',
            'password' => 'secret',
            'cpf' => '6318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('high-school-intern');

        $user = User::create([
            'name' => 'Edef Defensor Publico',
            'email' => 'defensor.publico@edefpr.com',
            'password' => 'secret',
            'cpf' => '7318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('public-defender');

        $user = User::create([
            'name' => 'Edef Psicologo',
            'email' => 'psicologo@edefpr.com',
            'password' => 'secret',
            'cpf' => '8318510005',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('psychologist');

        $user = User::create([
            'name' => 'Edef Master',
            'email' => 'master@edefpr.com',
            'password' => 'secret',
            'cpf' => '0000000000',
            'birth_date' => '2018-01-01',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'uf' => 'PR',
            'city' => 1,
            'number' => '123',
            'street' => 'Teste',
            'postcode' => '85015310',
            'complement' => '',
            'neighborhood' => 'Batel',
            'must_change_password' => 0,
            'remember_token' => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('master');
    }
}
