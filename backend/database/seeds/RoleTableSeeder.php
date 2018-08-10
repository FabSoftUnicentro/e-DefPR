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
            'open-process',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'distribution-office',
            'transfer-correction',
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
            'register-role',
            'update-role',
            'read-role',
            'delete-role',
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
            'open-process',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'initial-trial',
            'socioeconomic-scoring',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'register-employee',
            'update-employee',
            'read-employee',
            'append-protocol-to-process',
            'register-report',
            'send-for-analysis-to-defender'
        );

        $role = Role::create(['name' => 'administrative-technician']);
        $role->givePermissionTo(
            'register-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'initial-trial',
            'socioeconomic-scoring',
            'register-employee',
            'update-employee',
            'read-employee',
            'register-report'
        );

        $role = Role::create(['name' => 'social-worker']);
        $role->givePermissionTo(
            'register-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'initial-trial',
            'socioeconomic-scoring',
            'register-employee',
            'update-employee',
            'read-employee',
            'register-report',
            'social-attendance'
        );

        $role = Role::create(['name' => 'lawyer-intern']);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'register-report',
            'send-for-analysis-to-defender'
        );

        $role = Role::create(['name' => 'legal-adviser']);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'register-legal-attendance',
            'register-petition',
            'read-psychological-attendance',
            'append-protocol-to-process',
            'register-report',
            'send-for-analysis-to-defender'
        );

        $role = Role::create(['name' => 'high-school-intern']);
        $role->givePermissionTo(
            'register-activities',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'register-report'
        );

        $role = Role::create(['name' => 'public-defender']);
        $role->givePermissionTo(
            'register-activities',
            'open-process',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'generate-mail',
            'distribution-office',
            'transfer-correction',
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
            'social-attendance'
        );

        $role = Role::create(['name' => 'psychologist']);
        $role->givePermissionTo(
            'register-activities',
            'read-process',
            'open-protocol',
            'register-documents',
            'forward-attendance',
            'read-psychological-attendance',
            'register-report'
        );
    }
}
