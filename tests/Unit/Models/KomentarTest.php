<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Komentar;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KomentarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_factory()
    {
        $komentar = Komentar::factory()->create();
        
        $this->assertDatabaseHas('komentars', [
            'id_komentar' => $komentar->id_komentar,
            'pic_k' => $komentar->pic_k,
            'komentar' => $komentar->komentar
        ]);
    }
    
    /** @test */
    public function it_belongs_to_transaction()
    {
        $transaction = Transaction::factory()->create();
        $komentar = Komentar::factory()->create(['id_transactions' => $transaction->id_transaction]);
        
        $this->assertInstanceOf(Transaction::class, $komentar->transaction);
        $this->assertEquals($transaction->id_transaction, $komentar->transaction->id_transaction);
    }
    
    /** @test */
    public function it_has_fillable_attributes()
    {
        $komentar = new Komentar();
        
        $this->assertEquals([
            'id_transactions',
            'pic_k',
            'npk_k',
            'dep_k',
            'komentar',
        ], $komentar->getFillable());
    }
    
    /** @test */
    public function it_uses_correct_table_and_primary_key()
    {
        $komentar = new Komentar();
        
        $this->assertEquals('komentars', $komentar->getTable());
        $this->assertEquals('id_komentar', $komentar->getKeyName());
    }
}
