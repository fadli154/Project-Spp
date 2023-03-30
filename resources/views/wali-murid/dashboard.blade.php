@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-md-10 col-sm-8">
                        <h4 class="text-dark">Dashboard Wali Murid</h4>
                    </div>
                    <div class="col-md-2 col-sm-4  text-center items-center align-content-center mt-2 ">
                        <div class="breadcrumb-item d-inline"><a href="/dashboard">Dashboard</a></div>
                        {{-- <div class="breadcrumb-item d-inline"><a href="#">Layout</a></div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3 shadow-md">
            <p>Hallo {{ $greeting }} , {{ auth()->user()->level }}</p>
        </div>
    </section>
@endsection
