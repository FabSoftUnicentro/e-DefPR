<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'assign-role-permission',
            'assign-user-role',
            'list-permission',
            'register-permission',
            'update-permission',
            'delete-permission'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign created permissions
        $role = Role::create(['name' => 'master']);
        $role->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'juridical-administrative-technician']);
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
            'socioeconomic-scoring',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'read-attendance',
            'send-for-analysis-to-defender'
        );
        $role = Role::create(['name' => 'administrative-technician']);
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
            'socioeconomic-scoring',
            'register-employee',
            'update-employee',
            'read-employee',
            'read-attendance'
        );
        $role = Role::create(['name' => 'social-worker']);
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
            'register-individual-activities',
            'initial-trial',
            'socioeconomic-scoring',
            'register-report',
            'social-attendance'
        );
        $role = Role::create(['name' => 'lawyer-intern']);
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
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'send-for-analysis-to-defender'
        );
        $role = Role::create(['name' => 'legal-adviser']);
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
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'register-individual-activities',
            'send-for-analysis-to-defender'
        );
        $role = Role::create(['name' => 'high-school-intern']);
        $role->givePermissionTo(
            'register-activities',
            'read-attendance',
            'open-protocol',
            'delete-protocol',
            'forward-attendance',
            'generate-mail'
        );
        $role = Role::create(['name' => 'public-defender']);
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
            'delete-permission'
        );
        $role = Role::create(['name' => 'psychologist']);
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
            'psychological-attendance',
            'read-psychological-attendance',
            'authorize-consultation-of-psychological-attendance',
            'register-individual-activities'
        );
    }
}
