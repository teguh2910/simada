@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-users mr-2"></i>Select Suppliers for RFQ</h1>
            <p class="text-muted">{{ $rfq->title }}</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">RFQ</a></li>
              <li class="breadcrumb-item active">Select Suppliers</li>
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
            <div class="col-md-10">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-check-square mr-2"></i>Choose Suppliers</h3>
                        <div class="card-tools">
                            <span class="badge badge-info">{{ $suppliers->count() }} available suppliers</span>
                        </div>
                    </div>
                    <form action="{{ route('rfq.store-suppliers', $rfq) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if($suppliers->count() > 0)
                                <div class="row">
                                    @foreach($suppliers as $supplier)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="card supplier-card h-100">
                                                <div class="card-body">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="supplier{{ $supplier->id }}" name="suppliers[]" value="{{ $supplier->id }}">
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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                                <i class="fas fa-paper-plane mr-1"></i>Send RFQ to Selected Suppliers
                            </button>
                            <a href="{{ route('rfq.create') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left mr-1"></i>Back
                            </a>
                            <div class="float-right">
                                <small class="text-muted">Selected: <span id="selectedCount">0</span> suppliers</small>
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
    // Handle checkbox changes
    $('input[name="suppliers[]"]').change(function() {
        updateSelectedCount();
    });

    function updateSelectedCount() {
        var selected = $('input[name="suppliers[]"]:checked').length;
        $('#selectedCount').text(selected);
        $('#submitBtn').prop('disabled', selected === 0);
        
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

    // Initialize
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
