@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-plus-circle mr-2"></i>Create Request for Quotation</h1>
                    </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">RFQ</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="card-title"><i class="fas fa-file-plus mr-2"></i>RFQ Details</h3>
                    </div>
                    <form action="{{ route('rfq.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title"><i class="fas fa-heading mr-1"></i>Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter RFQ title" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date"><i class="fas fa-calendar-alt mr-1"></i>Due Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                        @error('due_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"><i class="fas fa-align-left mr-1"></i>Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter detailed description of your requirements" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="project"><i class="fas fa-project-diagram mr-1"></i>Project</label>
                                        <input type="text" class="form-control @error('project') is-invalid @enderror" id="project" name="project" value="{{ old('project') }}" placeholder="Project name (optional)">
                                        @error('project')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="part_number"><i class="fas fa-barcode mr-1"></i>Part Number</label>
                                        <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" value="{{ old('part_number') }}" placeholder="Part number (optional)">
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
                                    <i class="fas fa-info-circle mr-1"></i>You can upload multiple files. Supported formats: PDF, DOC, DOCX, XLS, XLSX, TXT, JPG, JPEG, PNG
                                </small>
                                @error('attachments')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-arrow-right mr-1"></i>Next: Select Suppliers
                            </button>
                            <a href="{{ route('rfq.index') }}" class="btn btn-default">
                                <i class="fas fa-times mr-1"></i>Cancel
                            </a>
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
            $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin mr-1"></i>Processing...').prop('disabled', true);
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
});
</script>
@show
@endsection
