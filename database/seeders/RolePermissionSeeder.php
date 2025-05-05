<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Désactiver les contraintes de clé étrangère
        Schema::disableForeignKeyConstraints();

        // Supprimer les données existantes
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // Réactiver les contraintes de clé étrangère
        Schema::enableForeignKeyConstraints();

        // Créer les permissions
        $permissions = [
            'view_dashboard',
            'view_roles',
            'view_salaires',
            'create_salaires',
            'edit_salaires',
            'delete_salaires',
            'view_depenses',
            'create_depenses',
            'edit_depenses',
            'delete_depenses',
            'manage_users',
            'manage_roles'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles et assigner les permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view_dashboard',
            'view_salaires',
            'create_salaires',
            'edit_salaires',
            'view_depenses',
            'create_depenses',
            'edit_depenses',
        ]);
    }
} 