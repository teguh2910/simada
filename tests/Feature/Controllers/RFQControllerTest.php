<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\RFQ;
use App\Models\Supplier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class RFQControllerTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function guests_cannot_access_rfq_pages()
    {
        $this->get('/rfq')->assertRedirect('/login');
        $this->get('/rfq/create')->assertRedirect('/login');
        
        // For POST request, we need to disable middleware to reach the auth check
        $this->withoutMiddleware();
        $this->post('/rfq', [])->assertStatus(419); // CSRF token mismatch is expected for guests
    }
    
    #[Test]
    public function users_can_view_their_rfqs()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->create(['created_by' => $user->id]);
        
        $response = $this->actingAs($user)->get('/rfq');
        
        $response->assertStatus(200);
        $response->assertSee($rfq->title);
    }
    
    #[Test]
    public function users_can_create_rfq_form()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/rfq/create');
        
        $response->assertStatus(200);
    }
    
    #[Test]
    public function users_can_store_rfq()
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $rfqData = [
            'title' => 'Test RFQ',
            'description' => 'Test Description',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'project' => 'Test Project',
            'part_number' => 'ABC-1234',
        ];
        $response = $this->actingAs($user)->post('/rfq', $rfqData);
        $response->assertRedirect();
        $this->assertDatabaseHas('rfqs', [
            'title' => 'Test RFQ',
            'created_by' => $user->id,
        ]);
    }
    
    #[Test]
    public function users_can_upload_attachments_with_rfq()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $rfqData = [
            'title' => 'Test RFQ with Attachment',
            'description' => 'Test Description',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'project' => 'Test Project',
            'part_number' => 'ABC-1234',
            'attachments' => [
                UploadedFile::fake()->create('document1.pdf', 100),
                UploadedFile::fake()->create('document2.pdf', 200),
            ]
        ];
        $response = $this->actingAs($user)
                        ->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class)
                        ->from('/rfq/create')
                        ->post('/rfq', $rfqData);
        $response->assertRedirect();
        $rfq = RFQ::where('title', 'Test RFQ with Attachment')->first();
        $this->assertNotNull($rfq);
        $this->assertCount(2, $rfq->attachments);
    }
    
    #[Test]
    public function users_can_view_rfq_details()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->create(['created_by' => $user->id]);
        
        $response = $this->actingAs($user)->get("/rfq/{$rfq->id}");
        
        $response->assertStatus(200);
        $response->assertSee($rfq->title);
    }
    
    #[Test]
    public function users_can_update_rfq()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->draft()->create(['created_by' => $user->id]);
        
        // Ensure the user is authenticated
        $this->actingAs($user);
        
        $updatedData = [
            'title' => 'Updated RFQ',
            'description' => 'Updated Description',
            'due_date' => now()->addDays(14)->format('Y-m-d'),
            'project' => 'Updated Project',
            'part_number' => 'XYZ-5678',
        ];
        
        $response = $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class)
                        ->from("/rfq/{$rfq->id}/edit")
                        ->put("/rfq/{$rfq->id}", $updatedData);
        $response->assertRedirect();
        $this->assertDatabaseHas('rfqs', [
            'id' => $rfq->id,
            'title' => 'Updated RFQ',
        ]);
    }
    
    #[Test]
    public function users_can_delete_rfq()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->draft()->create(['created_by' => $user->id]);
        
        // Ensure the user is authenticated
        $this->actingAs($user);
        
        $response = $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class)
                        ->from("/rfq/{$rfq->id}")
                        ->delete("/rfq/{$rfq->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('rfqs', [
            'id' => $rfq->id,
        ]);
    }
    
    #[Test]
    public function users_can_select_suppliers_for_rfq()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->create(['created_by' => $user->id]);
        $suppliers = Supplier::factory()->count(3)->create();
        
        $response = $this->actingAs($user)->get("/rfq/{$rfq->id}/select-suppliers");
        
        $response->assertStatus(200);
    }
    
    #[Test]
    public function users_can_store_selected_suppliers_for_rfq()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->draft()->create(['created_by' => $user->id]);
        $suppliers = Supplier::factory()->count(3)->create();
        
        // Ensure the user is authenticated
        $this->actingAs($user);
        
        $supplierData = [
            'suppliers' => $suppliers->pluck('id')->toArray(),
        ];
        $response = $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class)
                        ->from("/rfq/{$rfq->id}/select-suppliers")
                        ->post("/rfq/{$rfq->id}/select-suppliers", $supplierData);
        $response->assertRedirect();
        $this->assertCount(3, $rfq->suppliers()->get());
    }
}
