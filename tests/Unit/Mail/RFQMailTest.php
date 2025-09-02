<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Mail\RFQMail;
use App\Models\RFQ;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RFQMailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
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

        $mail->assertSeeInHtml($rfq->title);
        $mail->assertSeeInHtml($rfq->description);
        $mail->assertSeeInHtml($supplier->name);
        $mail->assertSeeInHtml($rfq->due_date->format('Y-m-d'));
    }

    /** @test */
    public function rfq_mail_has_correct_subject()
    {
        $rfq = RFQ::factory()->create([
            'title' => 'Test RFQ Title',
            'project' => 'Test Project',
        ]);

        $supplier = Supplier::factory()->create();

        $mail = new RFQMail($rfq, $supplier);

        $this->assertEquals('Request for Quotation: Test RFQ Title', $mail->subject);
    }

    /** @test */
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
