<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Document;
use App\Models\Komentar;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guests_cannot_access_protected_pages()
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/create')->assertRedirect('/login');
        $this->get('/draft')->assertRedirect('/login');
        $this->get('/final')->assertRedirect('/login');
        $this->get('/overdue')->assertRedirect('/login');
    }
    
    /** @test */
    public function users_can_view_dashboard()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_view_create_form()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/create');
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_store_new_transaction()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $document = Document::factory()->create();
        
        $transactionData = [
            'project' => 'Test Project',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'supplier' => 'Test Supplier',
            'part_number' => 'ABC-1234',
            'id_document' => $document->id,
            'file' => UploadedFile::fake()->create('document.pdf', 100),
            'pic' => $user->name,
            'npk' => $user->npk,
        ];
        
        $response = $this->actingAs($user)->post('/create', $transactionData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('transactions', [
            'project' => 'Test Project',
            'supplier' => 'Test Supplier',
        ]);
    }
    
    /** @test */
    public function users_can_view_draft_transactions()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['status' => 0]); // Assuming 0 is draft status
        
        $response = $this->actingAs($user)->get('/draft');
        
        $response->assertStatus(200);
        $response->assertSee($transaction->project);
    }
    
    /** @test */
    public function users_can_view_final_transactions()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['status' => 2]); // Assuming 2 is final status
        
        $response = $this->actingAs($user)->get('/final');
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_view_overdue_transactions()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create([
            'due_date' => now()->subDays(2),
            'status' => 0 // Not completed
        ]);
        
        $response = $this->actingAs($user)->get('/overdue');
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_upload_file_to_transaction()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();
        
        $uploadData = [
            'file' => UploadedFile::fake()->create('updated_doc.pdf', 100),
        ];
        
        $response = $this->actingAs($user)->post("/upload/{$transaction->id_transaction}", $uploadData);
        
        $response->assertRedirect();
        $updatedTransaction = Transaction::find($transaction->id_transaction);
        $this->assertStringContainsString('updated_doc.pdf', $updatedTransaction->file);
    }
    
    /** @test */
    public function users_can_revise_transaction()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['revise' => 0]);
        
        $response = $this->actingAs($user)->get("/revise/{$transaction->id_transaction}");
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_store_transaction_revisions()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['revise' => 0]);
        
        $revisionData = [
            'file' => UploadedFile::fake()->create('revised_doc.pdf', 100),
        ];
        
        $response = $this->actingAs($user)->post("/revise/{$transaction->id_transaction}", $revisionData);
        
        $response->assertRedirect();
        $updatedTransaction = Transaction::find($transaction->id_transaction);
        $this->assertEquals(1, $updatedTransaction->revise);
    }
    
    /** @test */
    public function users_can_provide_feedback_on_transaction()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();
        
        $response = $this->actingAs($user)->get("/feedback/{$transaction->id_transaction}");
        
        $response->assertStatus(200);
    }
    
    /** @test */
    public function users_can_store_feedback_on_transaction()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();
        
        $feedbackData = [
            'pic_k' => $user->name,
            'npk_k' => $user->npk,
            'dep_k' => $user->dept,
            'komentar' => 'This is a test feedback.',
        ];
        
        $response = $this->actingAs($user)->post("/feedback/{$transaction->id_transaction}", $feedbackData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('komentars', [
            'id_transactions' => $transaction->id_transaction,
            'komentar' => 'This is a test feedback.',
        ]);
    }
    
    /** @test */
    public function users_can_view_transaction_feedback()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();
        $komentar = Komentar::factory()->create(['id_transactions' => $transaction->id_transaction]);
        
        $response = $this->actingAs($user)->get("/viewfeedback/{$transaction->id_transaction}");
        
        $response->assertStatus(200);
        $response->assertSee($komentar->komentar);
    }
    
    /** @test */
    public function users_can_mark_transaction_as_final()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['status' => 1]); // Assuming 1 is not final
        
        $response = $this->actingAs($user)->get("/final/{$transaction->id_transaction}");
        
        $response->assertRedirect();
        $updatedTransaction = Transaction::find($transaction->id_transaction);
        $this->assertEquals(2, $updatedTransaction->status); // Assuming 2 is final status
    }
    
    /** @test */
    public function users_can_mark_transaction_as_not_needed()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['is_need' => true]);
        
        $response = $this->actingAs($user)->get("/noneed/{$transaction->id_transaction}");
        
        $response->assertRedirect();
        $updatedTransaction = Transaction::find($transaction->id_transaction);
        $this->assertFalse($updatedTransaction->is_need);
    }
    
    /** @test */
    public function users_can_delete_transaction()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();
        
        $response = $this->actingAs($user)->get("/del/{$transaction->id_transaction}");
        
        $response->assertRedirect();
        $this->assertDatabaseMissing('transactions', [
            'id_transaction' => $transaction->id_transaction,
        ]);
    }
}
