<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Request for Quotation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #2c3e50;">Request for Quotation</h1>

        <p>Dear {{ $supplier->name }},</p>

        <p>We are pleased to invite you to submit a quotation for the following requirement:</p>

        <div style="background-color: #f8f9fa; padding: 15px; margin: 20px 0; border-left: 4px solid #007bff;">
            <h3 style="margin-top: 0; color: #007bff;">{{ $rfq->title }}</h3>
            <p style="margin-bottom: 10px;"><strong>Description:</strong></p>
            <p style="margin-bottom: 10px;">{{ $rfq->description }}</p>

            @if($rfq->project)
                <p style="margin-bottom: 5px;"><strong>Project:</strong> {{ $rfq->project }}</p>
            @endif

            @if($rfq->part_number)
                <p style="margin-bottom: 5px;"><strong>Part Number:</strong> {{ $rfq->part_number }}</p>
            @endif

            <p style="margin-bottom: 5px;"><strong>Due Date:</strong> {{ $rfq->due_date->format('d F Y') }}</p>

            @if($rfq->attachments && count($rfq->attachments) > 0)
                <p style="margin-bottom: 5px;"><strong>Attachments:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($rfq->attachments as $attachment)
                        <li>{{ $attachment['original_name'] }} ({{ number_format($attachment['size'] / 1024, 1) }} KB)</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <p>Please submit your quotation by the due date mentioned above. We look forward to receiving your competitive offer.</p>

        <p>If you have any questions or require additional information, please don't hesitate to contact us.</p>

        <p>Best regards,<br>
        {{ $rfq->creator->name }}<br>
        {{ $rfq->creator->dept }} Department</p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

        <p style="font-size: 12px; color: #666;">
            This is an automated message from the SIMADA system. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
