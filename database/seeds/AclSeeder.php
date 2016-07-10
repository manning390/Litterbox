<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate tables
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        // Roles
        $mod = Role::create([
            'name'=>'mod',
            'label'=>'Moderator'
        ]);
        $ranger = Role::create([
            'name'=>'ranger',
            'label'=>'Ranger'
        ]);
        $dev = Role::create([
            'name'=>'dev',
            'label'=>'Developer'
        ]);
        $admin = Role::create([
            'name'=>'admin',
            'label'=>'Administrator'
        ]);

        // Permissions
        // Forum Management
        $editForum = Permission::create([
            'name'=>'edit_forum',
            'label'=>'Edit the Forum'
        ]);
        $lockForum = Permission::create([
            'name'=>'lock_forum',
            'label'=>'Lock the Forum'
        ]);
        $pinForum = Permission::create([
            'name'=>'pin_forum',
            'label'=>'Pin the Forum'
        ]);
        $deleteForum = Permission::create([
            'name'=>'delete_forum',
            'label'=>'Delete the Forum'
        ]);

        // User Management
        $managePMs = Permission::create([
            'name'=>'manage_pms',
            'label'=>'Manage Private Messages'
        ]);
        $manageProfiles = Permission::create([
            'name'=>'manage_profiles',
            'label'=>'Manage User Profiles'
        ]);
        $manageBadges = Permission::create([
            'name'=>'manage_badges',
            'label'=>'Manage Badge'
        ]);


        // Forum Bans
        $timeBan = Permission::create([
            'name'=>'time_ban',
            'label'=>'Time Ban a User'
        ]);
        $permBan = Permission::create([
            'name'=>'perm_ban',
            'label'=>'Permanently Ban a User'
        ]);
        $shadowBan = Permission::create([
            'name'=>'shadow_ban',
            'label'=>'Shadow Ban a User'
        ]);

        // Chat Bans
        $muteChat = Permission::create([
            'name'=>'mute_chat',
            'label'=>'Chat Mute a User'
        ]);
        $banChat = Permission::create([
            'name'=>'ban_chat',
            'label'=>'Chat Ban a User'
        ]);

        // Administration
        $makeAnnoucements = Permission::create([
            'name'=>'make_annoucement',
            'label'=>'Make Annoucements'
        ]);
        $viewAdministration = Permission::create([
            'name'=>'view_admin',
            'label'=>'View Administration'
        ]);
        $manageFlags = Permission::create([
            'name'=>'manage_flags',
            'label'=>'Manage Flags'
        ]);
        $managePermissions = Permission::create([
            'name'=>'manage_permissions',
            'label'=>'Manage Permissions'
        ]);
        $assumeUser = Permission::create([
            'name'=>'assume_user',
            'label'=>'Assume the Identity of a User'
        ]);

        // Role Permissions
        $mod->permissions()->saveMany([
            $viewAdministration,
            $editForum,
            $lockForum,
            $pinForum,
            $deleteForum,
            $timeBan,
            $permBan,
            $shadowBan,
            $muteChat,
            $banChat,
            $manageFlags,
            $managePMs,
            $manageProfiles,
            $manageBadges
        ]);
        $ranger->permissions()->saveMany([
            $viewAdministration,
            $muteChat,
            $banChat,
            $manageBadges
        ]);
        $dev->permissions()->saveMany([
            $viewAdministration,
            $assumeUser,
            $manageBadges
        ]);
        $admin->permissions()->saveMany(Permission::all());

    }
}
