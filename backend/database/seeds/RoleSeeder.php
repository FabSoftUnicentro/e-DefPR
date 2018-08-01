<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
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
        Permission::create(['name' => 'register-activities']);
        Permission::create(['name' => 'open-process']);
        Permission::create(['name' => 'read-process']);
        Permission::create(['name' => 'open-protocol']);
        Permission::create(['name' => 'register-documents']);
        Permission::create(['name' => 'forward-attendance']);
        Permission::create(['name' => 'generate-mail']);
        Permission::create(['name' => 'distribution-office']);
        Permission::create(['name' => 'transfer-correction']);
        Permission::create(['name' => 'adjust-petition']);
        Permission::create(['name' => 'initial-trial']);
        Permission::create(['name' => 'socioeconomic-scoring']);
        Permission::create(['name' => 'register-legal-attendance']);
        Permission::create(['name' => 'register-petition']);
        Permission::create(['name' => 'read-psychological-attendance']);
        Permission::create(['name' => 'read-report-from-all']);
        Permission::create(['name' => 'register-employee']);
        Permission::create(['name' => 'update-employee']);
        Permission::create(['name' => 'append-protocol-to-process']);
        Permission::create(['name' => 'register-report']);
        Permission::create(['name' => 'send-for-analysis-to-defender']);
        Permission::create(['name' => 'social-attendance']);
        Permission::create(['name' => 'read-attendance']);

        // create roles and assign created permissions
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

        $role = Role::create(['name' => 'master']);
        $role->givePermissionTo(Permission::all());
    }
}
