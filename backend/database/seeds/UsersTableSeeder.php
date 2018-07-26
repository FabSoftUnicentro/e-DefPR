<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 10)->create();
        $user = User::create([
            'name'                 => 'Edef Juridico',
            'email'                => 'juridico@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '1318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('juridical administrative technician');

        $user = User::create([
            'name'                 => 'Edef Administrador',
            'email'                => 'administrative@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '2318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerato.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('administrative technician');


        $user = User::create([
            'name'                 => 'Edef Assistente Social',
            'email'                => 'assistente.social@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '3318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('social worker');

        $user = User::create([
            'name'                 => 'Edef Estagiario Advogado',
            'email'                => 'estagiario.advogado@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '4318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('lawyer intern');

        $user = User::create([
            'name'                 => 'Edef Assessor Juridico',
            'email'                => 'assessor.juridico@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '5318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('legal adviser');

        $user = User::create([
            'name'                 => 'Edef Estagiario Ensino Medio',
            'email'                => 'estagiario.ensinomedio@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '6318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('high school intern');

        $user = User::create([
            'name'                 => 'Edef Defensor Publico',
            'email'                => 'defensor.publico@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '7318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('public defender');

        $user = User::create([
            'name'                 => 'Edef Psicologo',
            'email'                => 'psicologo@edefpr.com',
            'password'             => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'cpf'                  => '8318510005',
            'birth_date'           => '2001-02-07',
            'rg'                   => 'Quaerat.',
            'rg_issuer'            => 'SSP',
            'gender'               => 'M',
            'marital_status'       => 'Solteiro',
            'profession'           => 'Teste',
            'addresses'            => '[{"uf": "PR", "city": "Guarapuava", "number": 1, "street": "Teste", "postcode": "85015310", "complement": "", "neighborhood": "Batel"}]',
            'must_change_password' => 0,
            'remember_token'       => 'KjF6hUIZ2d'
        ]);
        $user->assignRole('psychologist');
    }
}
