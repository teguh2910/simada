<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Document;
use App\Models\Komentar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_factory()
    {
        $transaction = Transaction::factory()->create();
        
        $this->assertDatabaseHas('transactions', [
            'id_transaction' => $transaction->id_transaction,
            'project' => $transaction->project,
            'part_number' => $transaction->part_number
        ]);
    }
    
    /** @test */
    public function it_belongs_to_document()
    {
        $document = Document::factory()->create();
        $transaction = Transaction::factory()->create(['id_document' => $document->id]);
        
        $this->assertInstanceOf(Document::class, $transaction->document);
        $this->assertEquals($document->id, $transaction->document->id);
    }
    
    /** @test */
    public function it_has_many_komentars()
    {
        $transaction = Transaction::factory()->create();
        $komentar1 = Komentar::factory()->create(['id_transactions' => $transaction->id_transaction]);
        $komentar2 = Komentar::factory()->create(['id_transactions' => $transaction->id_transaction]);
        
        $this->assertCount(2, $transaction->komentars);
        $this->assertInstanceOf(Komentar::class, $transaction->komentars->first());
    }
    
    /** @test */
    public function it_has_casts()
    {
        $transaction = new Transaction();
        
        $this->assertEquals('date', $transaction->getCasts()['due_date']);
        $this->assertEquals('integer', $transaction->getCasts()['status']);
        $this->assertEquals('integer', $transaction->getCasts()['revise']);
        $this->assertEquals('boolean', $transaction->getCasts()['is_need']);
    }
    
    /** @test */
    public function it_has_fillable_attributes()
    {
        $transaction = new Transaction();
        
        $this->assertContains('project', $transaction->getFillable());
        $this->assertContains('part_number', $transaction->getFillable());
        $this->assertContains('status', $transaction->getFillable());
        $this->assertContains('id_document', $transaction->getFillable());
    }
}
