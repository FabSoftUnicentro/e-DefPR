<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\Permission as PermissionResource;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get a specific permission
     */
    public function testShow()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $permission = Permission::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $response =  $this->actingAs($admin)->get('/permission/' . $permission->id);

        $response->assertResource(PermissionResource::make($permission));
    }
}
