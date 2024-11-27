@extends('layout-admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Kamar</h5>
                <p class="card-text">20</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Kamar Kosong</h5>
                <p class="card-text">5</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Penyewa</h5>
                <p class="card-text">15</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Pendapatan Bulanan</h5>
                <p class="card-text">Rp 10,000,000</p>
            </div>
        </div>
    </div>
</div>
@endsection
