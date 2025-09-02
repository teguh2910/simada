<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_factory()
    {
        $user = User::factory()->create();
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email
        ]);
    }
    
    /** @test */
    public function it_can_check_if_user_is_admin()
    {
        $adminMIM = User::factory()->create(['dept' => 'MIM']);
        $adminNPL = User::factory()->create(['dept' => 'NPL']);
        $regularUser = User::factory()->create(['dept' => 'DEV']);
        
        $this->assertTrue($adminMIM->isAdmin());
        $this->assertTrue($adminNPL->isAdmin());
        $this->assertFalse($regularUser->isAdmin());
    }
    
    /** @test */
    public function it_hides_sensitive_attributes()
    {
        $user = User::factory()->create();
        $userArray = $user->toArray();
        
        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }
    
    /** @test */
    public function it_has_fillable_attributes()
    {
        $user = new User();
        
        $this->assertEquals([
            'name', 'email', 'password', 'dept', 'npk',
        ], $user->getFillable());
    }
}
