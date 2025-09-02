<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\RFQ;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RFQTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_factory()
    {
        $rfq = RFQ::factory()->create();
        
        $this->assertDatabaseHas('rfqs', [
            'id' => $rfq->id,
            'title' => $rfq->title,
            'project' => $rfq->project
        ]);
    }
    
    /** @test */
    public function it_belongs_to_creator()
    {
        $user = User::factory()->create();
        $rfq = RFQ::factory()->create(['created_by' => $user->id]);
        
        $this->assertInstanceOf(User::class, $rfq->creator);
        $this->assertEquals($user->id, $rfq->creator->id);
    }
    
    /** @test */
    public function it_belongs_to_many_suppliers()
    {
        $rfq = RFQ::factory()->create();
        $supplier1 = Supplier::factory()->create();
        $supplier2 = Supplier::factory()->create();
        
        $rfq->suppliers()->attach([
            $supplier1->id => ['sent_at' => now()],
            $supplier2->id => ['sent_at' => now()]
        ]);
        
        $this->assertCount(2, $rfq->suppliers);
        $this->assertInstanceOf(Supplier::class, $rfq->suppliers->first());
    }
    
    /** @test */
    public function it_has_draft_and_sent_states()
    {
        $draftRfq = RFQ::factory()->draft()->create();
        $sentRfq = RFQ::factory()->sent()->create();
        
        $this->assertEquals('draft', $draftRfq->status);
        $this->assertNull($draftRfq->sent_at);
        
        $this->assertEquals('sent', $sentRfq->status);
        $this->assertNotNull($sentRfq->sent_at);
    }
    
    /** @test */
    public function it_has_casts()
    {
        $rfq = new RFQ();
        
        $this->assertEquals('date', $rfq->getCasts()['due_date']);
        $this->assertEquals('datetime', $rfq->getCasts()['sent_at']);
        $this->assertEquals('array', $rfq->getCasts()['attachments']);
    }
    
    /** @test */
    public function it_stores_attachments()
    {
        Storage::fake('public');
        
        $rfq = RFQ::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $rfq->storeAttachments([$file]);
        
        $this->assertNotEmpty($rfq->fresh()->attachments);
        $attachment = $rfq->fresh()->attachments[0];
        $this->assertEquals('document.pdf', $attachment['original_name']);
        Storage::disk('public')->assertExists($attachment['path']);
    }
    
    /** @test */
    public function it_gets_attachment_paths()
    {
        Storage::fake('public');
        
        $rfq = RFQ::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $rfq->storeAttachments([$file]);
        
        $paths = $rfq->getAttachmentPaths();
        $this->assertNotEmpty($paths);
    }
}
