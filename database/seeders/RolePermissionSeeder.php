<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'order',
                'permissions' => [
                    'order.view',
                    'order.download',
                ]
            ],
            [
                'group_name' => 'company',
                'permissions' => [
                    // company permission
                    'company.create',
                    'company.view',
                    'company.update',
                    'company.delete',
                ]
            ],
            [
                'group_name' => 'map',
                'permissions' => [
                    // company permission
                    'map.create',
                    'map.view',
                    'map.update',
                    'map.delete',
                ]
            ],
            [
                'group_name' => 'candidate',
                'permissions' => [
                    'candidate.create',
                    'candidate.view',
                    'candidate.update',
                    'candidate.delete',
                ]
            ],
            [
                'group_name' => 'job',
                'permissions' => [
                    'job.create',
                    'job.view',
                    'job.update',
                    'job.delete',
                ]
            ],
            [
                'group_name' => 'job_category',
                'permissions' => [
                    'job_category.create',
                    'job_category.view',
                    'job_category.update',
                    'job_category.delete',
                ]
            ],
            [
                'group_name' => 'job_role',
                'permissions' => [
                    'job_role.view',
                    'job_role.create',
                    'job_role.update',
                    'job_role.delete'
                ]
            ],
            [
                'group_name' => 'price_plan',
                'permissions' => [
                    'plan.create',
                    'plan.view',
                    'plan.update',
                    'plan.delete',
                ]
            ],
            [
                'group_name' => 'attributes',
                'permissions' => [
                    'industry_types.create',
                    'industry_types.view',
                    'industry_types.update',
                    'industry_types.delete',
                    'professions.create',
                    'professions.view',
                    'professions.update',
                    'professions.delete',
                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    'post.create',
                    'post.view',
                    'post.update',
                    'post.delete'
                ]
            ],
            [
                'group_name' => 'location',
                'permissions' => [
                    'country.create',
                    'country.view',
                    'country.update',
                    'country.delete',
                    'state.create',
                    'state.view',
                    'state.update',
                    'state.delete',
                    'city.create',
                    'city.view',
                    'city.update',
                    'city.delete',
                ]
            ],
            [
                'group_name' => 'newsletter',
                'permissions' => [
                    'newsletter.view',
                    'newsletter.sendmail',
                    'newsletter.delete'
                ]
            ],
            [
                'group_name' => 'contact',
                'permissions' => [
                    'contact.view',
                    'contact.delete',
                ]
            ],
            [
                'group_name' => 'testimonial',
                'permissions' => [
                    'testimonial.create',
                    'testimonial.view',
                    'testimonial.update',
                    'testimonial.delete',
                ]
            ],
            [
                'group_name' => 'faq',
                'permissions' => [
                    'faq.create',
                    'faq.view',
                    'faq.update',
                    'faq.delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'settings',
                'permissions' => [
                    'setting.view',
                    'setting.update',
                ]
            ]
        ];

        // Assaign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                    'guard_name' => 'admin'
                ]);

                $roleSuperAdmin->givePermissionTo($permission);
            }
        }
    }
}
