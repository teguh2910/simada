@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-eye mr-2"></i>{{ $rfq->title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">RFQ</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- RFQ Details Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>RFQ Details</h3>
                        <div class="card-tools">
                            @if($rfq->status == 'sent')
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>{{ ucfirst($rfq->status) }}
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-clock mr-1"></i>{{ ucfirst($rfq->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-primary"><i class="fas fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Due Date</span>
                                        <span class="info-box-number">{{ $rfq->due_date->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Created By</span>
                                        <span class="info-box-number">{{ $rfq->creator->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($rfq->project || $rfq->part_number)
                            <div class="row">
                                @if($rfq->project)
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success"><i class="fas fa-project-diagram"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Project</span>
                                                <span class="info-box-number">{{ $rfq->project }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($rfq->part_number)
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-barcode"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Part Number</span>
                                                <span class="info-box-number">{{ $rfq->part_number }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-calendar-plus mr-1"></i>Created:</strong> {{ $rfq->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                @if($rfq->sent_at)
                                    <p><strong><i class="fas fa-paper-plane mr-1"></i>Sent:</strong> {{ $rfq->sent_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>Description</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">{{ $rfq->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Suppliers Card -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users mr-2"></i>Suppliers ({{ $rfq->suppliers->count() }})</h3>
                    </div>
                    <div class="card-body">
                        @if($rfq->suppliers->count() > 0)
                            @foreach($rfq->suppliers as $supplier)
                                <div class="user-block mb-3">
                                    <span class="img-circle img-bordered-sm bg-primary d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-building text-white"></i>
                                    </span>
                                    <span class="username">
                                        <strong>{{ $supplier->name }}</strong>
                                        @if($supplier->pivot->sent_at)
                                            <small class="text-success"><i class="fas fa-check-circle"></i></small>
                                        @endif
                                    </span>
                                    <span class="description">
                                        <i class="fas fa-envelope mr-1"></i>{{ $supplier->email }}
                                        @if($supplier->contact_person)
                                            <br><small class="text-muted">Contact: {{ $supplier->contact_person }}</small>
                                        @endif
                                        @if($supplier->pivot->sent_at)
                                            <br><small class="text-success">Sent: {{ $supplier->pivot->sent_at->format('d/m/Y H:i') }}</small>
                                        @endif
                                    </span>
                                </div>
                                
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No suppliers selected yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-cogs mr-2"></i>Actions</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('rfq.index') }}" class="btn btn-default btn-block">
                            <i class="fas fa-arrow-left mr-1"></i>Back to RFQs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
