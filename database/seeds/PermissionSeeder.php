<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        foreach (Route::getRoutes()->getRoutes() as $route) {

            $action_object = $route->getAction();

            if (!empty($action_object['controller'])) {

                if(is_array($action_object['middleware'])){

                    if(in_array('auth',  $action_object['middleware'])) {

                        $array  = explode('.', $action_object['as']);
                        Permission::create([
                           'object' => $array[0],
                           'action' => $array[1],
                           'name' => $action_object['as'],
                        ]);
                    }
                }
            }

        }
    }
}
