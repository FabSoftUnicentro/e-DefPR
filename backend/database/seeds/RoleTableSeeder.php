<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        // create permissions
        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'read-mail',
            'authorize-consultation-of-social-worker-attendance',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'adjust-petition',
            'initial-trial',
            'socioeconomic-scoring',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'read-report-from-all',
            'register-employee',
            'update-employee',
            'read-employee',
            'delete-employee',
            'append-protocol-to-process',
            'register-report',
            'send-for-analysis-to-defender',
            'social-attendance',
            'read-attendance',
            'register-state',
            'update-state',
            'delete-state',
            'register-city',
            'update-city',
            'delete-city',
            'register-assisted',
            'update-assisted',
            'delete-assisted',
            'psychological-attendance',
            'authorize-consultation-of-psychological-attendance',
            'register-individual-activities',
            'delete-attendance',
            'delete-registration',
            'judge-petition',
            'intake-order',
            'transfer-petition-remedy',
            'register-role',
            'update-role',
            'read-role',
            'delete-role',
            'assign-user-permission',
            'unassign-user-permission',
            'assign-role-permission',
            'unassign-role-permission',
            'assign-user-role',
            'unassign-user-role',
            'list-permission',
            'register-permission',
            'update-permission',
            'delete-permission',
            'list-attendment',
            'list-my-permissions',
            'list-all-permissions',
            'register-attendment',
            'update-attendment',
            'delete-attendment',
            'list-attendmentType',
            'register-attendmentType',
            'update-attendmentType',
            'delete-attendmentType',
            'register-counterPart',
            'update-counterPart',
            'delete-counterPart',
            'register-relative',
            'update-relative',
            'delete-relative'
        ];
        $descriptions = [
            'Registrar Atividades',
            'Registro Geral de Atividades',
            'Abrir Processo',
            'Visualizar Processo',
            'Abrir Protocolo',
            'Excluir Protocolo',
            'Visualizar E-mail',
            'Autorizar Consulta a Atendimento de Assistente Social',
            'Registrar documentos',
            'Encaminhar Atendimento',
            'Gerar e-mail',
            'Corrigir Petição',
            'Triagem Inicial',
            'Triagem Socioeconômica',

            'Registrar Atendimento Legal',

            'Confeccionar Petição',
            'Atendimento Psicológico',
            'Gerar Relatório Geral de Atividades',
            'Registrar Funcionário',
            'Atualizar Funcionário',
            'Visualizar Funcionário',
            'Excluir Funcionário',
            'Apensar Protocolo ao Processo',
            'Registrar Atividade',
            'Enviar Petição para Análise pelo Defensor',
            'Atendimento Social',
            'Visualizar Atendimento',
            'Registrar Estado',
            'Atualizar Estado',
            'Excluir Estado',
            'Registrar Cidade',
            'Atualizar Cidade',
            'Excluir Cidade',
            'Registrar Assistido',
            'Atualizar Assistido',
            'Excluir Assistido',
            'Atendimento Psicológico',
            'Autorizar Consulta a Atendimento Psicológico',
            'Gerar Relatório Individual de Atividades',
            'Excluir Atendimento',

            'Excluir Registro',

            'Ajuizar Petição',
            'Despacho de Instauração',
            'Transferir Correção de Petição',
            'Registrar Papel',
            'Atualizar Papel',
            'Visualizar Papel',
            'Excluir Papel',
            'Atribuir Permissão a Funcionário',
            'Desatribuir Permissão a Funcionário',
            'Atribuir Permissão a Papel',
            'Desatribuir Permissão a Papel',
            'Atribuir papel a Funcionário',
            'Desatribuir papel a Funcionário',
            'Visualizar Permissão',
            'Registrar Permissão',
            'Atualizar Permissão',
            'Excluir Permissão',
            'Visualizar Atendimento',
            'Visualizar Minhas Permissões',
            'Visualizar Todas as Permissões',
            'Registrar Atendimento',
            'Atualizar Atendimento',
            'Excluir Atendimento',
            'Visualizar Tipo de Atendimento',
            'Registrar Tipo de Atendimento',
            'Atualizar Tipo de Atendimento',
            'Excluir Tipo de Atendimento',
            'Registrar Parte Contrária',
            'Atualizar Parte Contrária',
            'Excluir Parte Contrária',
            'Registrar Parente',
            'Atualizar Parente',
            'Excluir Parente'
            ];
        foreach (array_combine($permissions, $descriptions) as $permission => $description) {
            Permission::create([
                'name' => $permission,
                'description' => $description
            ]);
        }
        // create roles and assign created permissions
        $role = Role::create([
            'name' => 'master',
            'description' => 'master'
        ]);
        $role->givePermissionTo(Permission::all());
        $role = Role::create([
            'name' => 'juridical-administrative-technician',
            'description' => 'Técnico Administrativo Jurídico'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'register-individual-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'read-mail',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'initial-trial',
            'list-all-permissions',
            'list-my-permissions',
            'socioeconomic-scoring',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'read-attendance',
            'send-for-analysis-to-defender',
            'list-attendment',
            'register-attendment',
            'register-assisted',
            'update-assisted',
            'delete-assisted',
            'register-counterPart',
            'update-counterPart',
            'delete-counterPart',
            'register-relative',
            'update-relative',
            'delete-relative'
        );
        $role = Role::create([
            'name' => 'administrative-technician',
            'description' => 'Técnico Administrativo'
            ]);
        $role->givePermissionTo(
            'register-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'read-mail',
            'initial-trial',
            'list-my-permissions',
            'list-all-permissions',
            'socioeconomic-scoring',
            'register-employee',
            'update-employee',
            'read-employee',
            'read-attendance',
            'list-attendment',
            'register-attendment',
            'register-assisted',
            'update-assisted',
            'delete-assisted',
            'register-counterPart',
            'update-counterPart',
            'delete-counterPart',
            'register-relative',
            'update-relative',
            'delete-relative'
        );
        $role = Role::create([
            'name' => 'social-worker',
            'description' => 'Assistente Social'
            ]);
        $role->givePermissionTo(
            'register-activities',
            'open-process',
            'read-attendance',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'authorize-consultation-of-social-worker-attendance',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'read-mail',
            'list-my-permissions',
            'register-individual-activities',
            'initial-trial',
            'socioeconomic-scoring',
            'register-report',
            'social-attendance',
            'list-attendment',
            'register-attendment'
        );
        $role = Role::create([
            'name' => 'lawyer-intern',
            'description' => 'Estagiário de Direito'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'delete-protocol',
            'register-documents',
            'forward-attendance',
            'read-attendance',
            'register-individual-activities',
            'initial-trial',
            'read-mail',
            'list-my-permissions',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'send-for-analysis-to-defender',
            'list-attendment',
            'register-attendment'
        );
        $role = Role::create([
            'name' => 'legal-adviser',
            'description' => 'Assessor Juridico'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'read-attendance',
            'open-process',
            'open-protocol',
            'initial-trial',
            'socioeconomic-scoring',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'read-mail',
            'list-my-permissions',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'register-individual-activities',
            'send-for-analysis-to-defender',
            'list-attendment',
            'register-attendment'
        );
        $role = Role::create([
            'name' => 'high-school-intern',
            'description' => 'Estagiário de Ensino Médio'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'read-attendance',
            'open-protocol',
            'delete-protocol',
            'list-my-permissions',
            'forward-attendance',
            'generate-mail',
            'list-attendment',
            'register-attendment'
        );
        $role = Role::create([
            'name' => 'public-defender',
            'description' => 'Defensor Público'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'register-general-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'register-employee',
            'update-employee',
            'read-employee',
            'transfer-petition-remedy',
            'read-mail',
            'list-my-permissions',
            'list-all-permissions',
            'authorize-consultation-of-social-worker-attendance',
            'authorize-consultation-of-psychological-attendance',
            'register-documents',
            'forward-attendance',
            'intake-order',
            'generate-mail',
            'adjust-petition',
            'judge-petition',
            'initial-trial',
            'socioeconomic-scoring',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'read-report-from-all',
            'append-protocol-to-process',
            'register-report',
            'read-attendance',
            'register-individual-activities',
            'assign-user-role',
            'assign-role-permission',
            'assign-user-permission',
            'list-permission',
            'register-permission',
            'update-permission',
            'delete-permission',
            'list-attendment',
            'register-attendment',
            'register-assisted',
            'update-assisted',
            'delete-assisted',
            'register-counterPart',
            'update-counterPart',
            'delete-counterPart',
            'register-relative',
            'update-relative',
            'delete-relative'
        );
        $role = Role::create([
            'name' => 'psychologist',
            'description' => 'Psicólogo'
        ]);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'open-protocol',
            'delete-protocol',
            'register-documents',
            'forward-attendance',
            'read-mail',
            'generate-mail',
            'register-report',
            'list-my-permissions',
            'psychological-attendance',
            'read-psychological-attendance',
            'authorize-consultation-of-psychological-attendance',
            'register-individual-activities',
            'register-attendment'
        );
    }
}
