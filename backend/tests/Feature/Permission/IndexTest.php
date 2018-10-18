<?php

namespace Tests\Feature\Permission;

use Spatie\Permission\Models\Permission;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\Permission as PermissionResource;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all permissions paginated
     */
    public function testIndex()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $response = $this->actingAs($admin)->get('/permission');

        $permissions = Permission::paginate(10);

        $response->assertResource(PermissionResource::collection($permissions));
    }
}
