<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Supplier;
use App\Models\RFQ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_be_created_with_factory()
    {
        $supplier = Supplier::factory()->create();
        
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'email' => $supplier->email
        ]);
    }
    
    #[Test]
    public function it_can_be_active_or_inactive()
    {
        $activeSupplier = Supplier::factory()->active()->create();
        $inactiveSupplier = Supplier::factory()->inactive()->create();
        
        $this->assertTrue($activeSupplier->is_active);
        $this->assertFalse($inactiveSupplier->is_active);
    }
    
    #[Test]
    public function it_belongs_to_many_rfqs()
    {
        $supplier = Supplier::factory()->create();
        $rfq = RFQ::factory()->create();
        
        $supplier->rfqs()->attach($rfq, ['sent_at' => now()]);
        
        $this->assertCount(1, $supplier->rfqs);
        $this->assertInstanceOf(RFQ::class, $supplier->rfqs->first());
    }
    
    #[Test]
    public function it_has_fillable_attributes()
    {
        $supplier = new Supplier();
        
        $this->assertEquals([
            'name',
            'email',
            'contact_person',
            'phone',
            'address',
            'is_active',
        ], $supplier->getFillable());
    }
    
    #[Test]
    public function it_has_casts()
    {
        $supplier = new Supplier();
        
        $this->assertEquals('boolean', $supplier->getCasts()['is_active']);
    }
}
