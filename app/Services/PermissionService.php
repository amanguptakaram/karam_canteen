<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    public function syncFromConfig(): void
    {
        $permissions = config('permissions', []);

        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action) {

                $slug = $module . '.' . $action;

                $name = ucwords(
                    str_replace(
                        ['.', '_', '-'],
                        ' ',
                        $slug
                    )
                );

                Permission::updateOrCreate(
                    ['slug' => $slug],
                    ['name' => $name]
                );
            }
        }
    }
}