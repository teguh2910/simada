<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Mail\RFQMail;
use App\Models\RFQ;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class RFQMailTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function rfq_mail_has_correct_content()
    {
        $rfq = RFQ::factory()->create([
            'title' => 'Test RFQ Title',
            'description' => 'Test RFQ Description',
            'due_date' => now()->addDays(7),
            'project' => 'Test Project',
        ]);

        $supplier = Supplier::factory()->create([
            'name' => 'Test Supplier',
            'email' => 'supplier@example.com',
        ]);

        $mail = new RFQMail($rfq, $supplier);

        $rendered = $mail->render();

        $this->assertStringContainsString($rfq->title, $rendered);
        $this->assertStringContainsString($rfq->description, $rendered);
        $this->assertStringContainsString($supplier->name, $rendered);
        $this->assertStringContainsString($rfq->due_date->format('d F Y'), $rendered);
    }

    #[Test]
    public function rfq_mail_has_correct_subject()
    {
        $rfq = RFQ::factory()->create([
            'title' => 'Test RFQ Title',
            'project' => 'Test Project',
        ]);

        $supplier = Supplier::factory()->create();

        $mail = new RFQMail($rfq, $supplier);

        $this->assertEquals('Request for Quotation: Test RFQ Title', $mail->envelope()->subject);
    }

    #[Test]
    public function rfq_mail_includes_attachments_if_present()
    {
        $rfq = RFQ::factory()->create();
        $supplier = Supplier::factory()->create();

        // Mock the RFQ to have attachments
        $rfq->attachments = [
            [
                'original_name' => 'document1.pdf',
                'path' => 'rfq_attachments/document1.pdf',
            ]
        ];

        $mail = new RFQMail($rfq, $supplier);

        // This is a simple check that won't actually send the email
        $this->assertNotEmpty($mail->attachments);
    }
}
