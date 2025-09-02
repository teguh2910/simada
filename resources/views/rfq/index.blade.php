@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-file-invoice-dollar mr-2"></i>Request for Quotations</h1>
                    </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">RFQ</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list mr-2"></i>RFQ Management</h3>
                        <div class="card-tools">
                            <a href="{{ route('rfq.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus mr-1"></i>Create New RFQ
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i>{{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><i class="fas fa-file-alt mr-1"></i>Title</th>
                                        <th><i class="fas fa-calendar-alt mr-1"></i>Due Date</th>
                                        <th><i class="fas fa-info-circle mr-1"></i>Status</th>
                                        <th><i class="fas fa-users mr-1"></i>Suppliers</th>
                                        <th><i class="fas fa-paperclip mr-1"></i>Attachments</th>
                                        <th><i class="fas fa-clock mr-1"></i>Created</th>
                                        <th class="text-center"><i class="fas fa-cogs mr-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rfqs as $rfq)
                                        <tr class="fade-in">
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <strong class="text-primary">{{ $rfq->title }}</strong>
                                                    @if($rfq->project)
                                                        <small class="text-muted">
                                                            <i class="fas fa-project-diagram mr-1"></i>{{ $rfq->project }}
                                                        </small>
                                                    @endif
                                                    @if($rfq->part_number)
                                                        <small class="text-info">
                                                            <i class="fas fa-barcode mr-1"></i>{{ $rfq->part_number }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info badge-lg">
                                                    <i class="fas fa-calendar mr-1"></i>{{ $rfq->due_date->format('d M Y') }}
                                                </span>
                                                @if($rfq->due_date->isPast())
                                                    <br><small class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i>Overdue</small>
                                                @elseif($rfq->due_date->isToday())
                                                    <br><small class="text-warning"><i class="fas fa-clock mr-1"></i>Due Today</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rfq->status == 'sent')
                                                    <span class="badge badge-success badge-lg">
                                                        <i class="fas fa-paper-plane mr-1"></i>{{ ucfirst($rfq->status) }}
                                                    </span>
                                                @elseif($rfq->status == 'draft')
                                                    <span class="badge badge-secondary badge-lg">
                                                        <i class="fas fa-edit mr-1"></i>{{ ucfirst($rfq->status) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning badge-lg">
                                                        <i class="fas fa-clock mr-1"></i>{{ ucfirst($rfq->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rfq->suppliers->count() > 0)
                                                    <span class="badge badge-primary badge-lg">
                                                        <i class="fas fa-users mr-1"></i>{{ $rfq->suppliers->count() }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-user-times mr-1"></i>None
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rfq->attachments && count($rfq->attachments) > 0)
                                                    <span class="badge badge-info badge-lg">
                                                        <i class="fas fa-paperclip mr-1"></i>{{ count($rfq->attachments) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-minus mr-1"></i>None
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted">
                                                    <i class="fas fa-calendar-plus mr-1"></i>{{ $rfq->created_at->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('rfq.show', $rfq) }}" class="btn btn-info btn-sm" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($rfq->status === 'draft')
                                                        <a href="{{ route('rfq.edit', $rfq) }}" class="btn btn-warning btn-sm" title="Edit RFQ">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('rfq.destroy', $rfq) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this RFQ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete RFQ">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="fas fa-file-invoice-dollar fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No RFQs found</h5>
                                                    <p class="text-muted">Get started by creating your first RFQ</p>
                                                    <a href="{{ route('rfq.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus mr-1"></i>Create your first RFQ
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($rfqs->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $rfqs->links() }}
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <small class="text-muted">
                                    Showing {{ $rfqs->firstItem() ?? 0 }} to {{ $rfqs->lastItem() ?? 0 }} of {{ $rfqs->total() }} RFQs
                                </small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small class="text-muted">
                                    <i class="fas fa-clock mr-1"></i>Last updated: {{ now()->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->

@section('js')
<script>
$(document).ready(function() {
    // Add smooth scrolling
    $('html, body').css({
        'scroll-behavior': 'smooth'
    });
    
    // Add loading animation to action buttons
    $('.btn').on('click', function() {
        if ($(this).attr('type') !== 'button') {
            $(this).addClass('loading');
        }
    });
    
    // Auto refresh every 5 minutes
    setTimeout(function() {
        if (window.location.pathname.includes('/rfq')) {
            window.location.reload();
        }
    }, 300000); // 5 minutes
    
    // Add tooltips to badges
    $('[data-toggle="tooltip"]').tooltip();
    
    // Animate table rows on load
    $('.fade-in').each(function(index) {
        $(this).delay(index * 100).animate({
            opacity: 1
        }, 500);
    });
});
</script>

@show
@endsection
