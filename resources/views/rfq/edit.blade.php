@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-edit mr-2"></i>Edit Request for Quotation</h1>
                    </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">RFQ</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-edit mr-2"></i>RFQ Details</h3>
                    </div>
                    <form action="{{ route('rfq.update', $rfq) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title"><i class="fas fa-heading mr-1"></i>Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $rfq->title) }}" placeholder="Enter RFQ title" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date"><i class="fas fa-calendar-alt mr-1"></i>Due Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $rfq->due_date->format('Y-m-d')) }}" required>
                                        @error('due_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"><i class="fas fa-align-left mr-1"></i>Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter detailed description of your requirements" required>{{ old('description', $rfq->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="project"><i class="fas fa-project-diagram mr-1"></i>Project</label>
                                        <input type="text" class="form-control @error('project') is-invalid @enderror" id="project" name="project" value="{{ old('project', $rfq->project) }}" placeholder="Project name (optional)">
                                        @error('project')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="part_number"><i class="fas fa-barcode mr-1"></i>Part Number</label>
                                        <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" value="{{ old('part_number', $rfq->part_number) }}" placeholder="Part number (optional)">
                                        @error('part_number')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="attachments"><i class="fas fa-paperclip mr-1"></i>Attachments</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" for="attachments">Choose files...</label>
                                </div>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>You can upload additional files. Supported formats: PDF, DOC, DOCX, XLS, XLSX, TXT, JPG, JPEG, PNG
                                </small>
                                @if($rfq->attachments && count($rfq->attachments) > 0)
                                    <div class="mt-2">
                                        <small class="text-info">
                                            <i class="fas fa-info-circle mr-1"></i>Current attachments: {{ count($rfq->attachments) }} file(s)
                                        </small>
                                    </div>
                                @endif
                                @error('attachments')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Supplier Selection Section -->
                            <div class="card border-info mt-4">
                                <div class="card-header bg-info">
                                    <h5 class="card-title mb-0"><i class="fas fa-users mr-2"></i>Select Suppliers</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $allSuppliers = \App\Models\Supplier::where('is_active', true)->get();
                                        $selectedSupplierIds = $rfq->suppliers->pluck('id')->toArray();
                                    @endphp

                                    @if($allSuppliers->count() > 0)
                                        <div class="row">
                                            @foreach($allSuppliers as $supplier)
                                                <div class="col-md-6 col-lg-4 mb-3">
                                                    <div class="card supplier-card h-100 {{ in_array($supplier->id, $selectedSupplierIds) ? 'border-success' : '' }}">
                                                        <div class="card-body">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                       class="custom-control-input"
                                                                       id="supplier{{ $supplier->id }}"
                                                                       name="suppliers[]"
                                                                       value="{{ $supplier->id }}"
                                                                       {{ in_array($supplier->id, $selectedSupplierIds) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="supplier{{ $supplier->id }}">
                                                                    <strong>{{ $supplier->name }}</strong>
                                                                </label>
                                                            </div>
                                                            <div class="mt-2">
                                                                @if($supplier->contact_person)
                                                                    <p class="mb-1"><i class="fas fa-user mr-1"></i>{{ $supplier->contact_person }}</p>
                                                                @endif
                                                                <p class="mb-1"><i class="fas fa-envelope mr-1"></i>{{ $supplier->email }}</p>
                                                                @if($supplier->phone)
                                                                    <p class="mb-0"><i class="fas fa-phone mr-1"></i>{{ $supplier->phone }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="mt-3">
                                            <small class="text-muted">
                                                Selected: <span id="selectedCount">{{ count($selectedSupplierIds) }}</span> suppliers
                                            </small>
                                            <div class="float-right">
                                                <button type="button" class="btn btn-sm btn-outline-primary select-all">Select All</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary clear-all">Clear All</button>
                                            </div>
                                        </div>

                                        @error('suppliers')
                                            <div class="alert alert-danger mt-3">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No suppliers available</h5>
                                            <p class="text-muted">Please add suppliers to the system first.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Email Options -->
                            <div class="form-group mt-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="send_email" name="send_email" value="1" checked>
                                    <label class="custom-control-label" for="send_email">
                                        <strong><i class="fas fa-envelope mr-1"></i>Send Email Notification</strong>
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>If checked, an email will be sent to all selected suppliers with the updated RFQ details.
                                </small>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>Update RFQ
                            </button>
                            <a href="{{ route('rfq.show', $rfq) }}" class="btn btn-info">
                                <i class="fas fa-eye mr-1"></i>View Details
                            </a>
                            <a href="{{ route('rfq.index') }}" class="btn btn-default">
                                <i class="fas fa-times mr-1"></i>Cancel
                            </a>
                            <div class="float-right">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>Check "Send Email" to notify suppliers
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->

@section('js')
<script>
$(document).ready(function() {
    // Update file input label when files are selected
    $('#attachments').on('change', function() {
        var files = this.files;
        var label = $(this).next('.custom-file-label');

        if (files.length === 0) {
            label.html('Choose files...');
        } else if (files.length === 1) {
            label.html(files[0].name);
        } else {
            label.html(files.length + ' files selected');
        }
    });

    // Form validation enhancement
    $('form').on('submit', function(e) {
        let isValid = true;

        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Validate required fields
        $('input[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">This field is required.</div>');
                isValid = false;
            }
        });

        // Validate due date
        const dueDate = new Date($('#due_date').val());
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (dueDate < today) {
            $('#due_date').addClass('is-invalid');
            $('#due_date').after('<div class="invalid-feedback">Due date cannot be in the past.</div>');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            $('html, body').animate({
                scrollTop: $('.is-invalid:first').offset().top - 100
            }, 500);
        } else {
            // Add loading state to submit button
            var sendEmail = $('#send_email').is(':checked');
            var loadingText = sendEmail ? 'Updating and Sending...' : 'Updating...';
            $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin mr-1"></i>' + loadingText).prop('disabled', true);
        }
    });

    // Character counter for description
    $('#description').on('input', function() {
        const maxLength = 1000;
        const currentLength = $(this).val().length;
        const remaining = maxLength - currentLength;

        if (!$('#char-counter').length) {
            $(this).after('<small id="char-counter" class="form-text text-muted"></small>');
        }

        $('#char-counter').text(`${currentLength}/${maxLength} characters`);

        if (remaining < 50) {
            $('#char-counter').removeClass('text-muted').addClass('text-warning');
        } else {
            $('#char-counter').removeClass('text-warning').addClass('text-muted');
        }
    });

    // Auto-resize textarea
    $('#description').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Set minimum date to today
    $('#due_date').attr('min', new Date().toISOString().split('T')[0]);

    // Supplier selection functionality
    $('input[name="suppliers[]"]').change(function() {
        updateSelectedCount();
    });

    function updateSelectedCount() {
        var selected = $('input[name="suppliers[]"]:checked').length;
        $('#selectedCount').text(selected);

        // Update card styling for selected suppliers
        $('input[name="suppliers[]"]').each(function() {
            var card = $(this).closest('.supplier-card');
            if ($(this).is(':checked')) {
                card.addClass('border-success');
            } else {
                card.removeClass('border-success');
            }
        });
    }

    // Select all functionality
    $(document).on('click', '.select-all', function(e) {
        e.preventDefault();
        $('input[name="suppliers[]"]').prop('checked', true).trigger('change');
    });

    // Clear selection functionality
    $(document).on('click', '.clear-all', function(e) {
        e.preventDefault();
        $('input[name="suppliers[]"]').prop('checked', false).trigger('change');
    });

    // Initialize supplier selection
    updateSelectedCount();
});
</script>

<style>
.supplier-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.supplier-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.supplier-card.border-success {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.supplier-card .card-body {
    padding: 1rem;
}

.custom-control-label {
    cursor: pointer;
    width: 100%;
}
</style>
@show
@endsection
