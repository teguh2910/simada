<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Document;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_be_created_with_factory()
    {
        $document = Document::factory()->create();
        
        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'kinds_doc' => $document->kinds_doc,
            'documents' => $document->documents
        ]);
    }
    
    #[Test]
    public function it_has_many_transactions()
    {
        $document = Document::factory()->create();
        $transaction1 = Transaction::factory()->create(['id_document' => $document->id]);
        $transaction2 = Transaction::factory()->create(['id_document' => $document->id]);
        
        $this->assertCount(2, $document->transactions);
        $this->assertInstanceOf(Transaction::class, $document->transactions->first());
    }
    
    #[Test]
    public function it_has_fillable_attributes()
    {
        $document = new Document();
        
        $this->assertEquals([
            'kinds_doc',
            'documents',
        ], $document->getFillable());
    }
}
