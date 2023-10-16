@extends('master')
@section('title', 'View Car Details')

@section('main_section')
<div class="create">
    <div class="create_content">
        <div class="container">
            <div class="row pt-2">
                <div class="col-lg-12 d-flex justify-content-between align-items-center mx-auto">
                    <h2>View Car Details</h2>
                    <a href="/dashboard" class="btn btn-warning rounded">Goto Home</a>
                </div>
            </div>
            <hr class="my-2">
            <div class="row my-3">
            <div class="col-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-info">
                        <h3 class="text-dark text-center fw-bold">Car Details</h3>
                    </div>
                    <div class="card-body p-4">
                        @isset($results)
                        @foreach ($results as $result)
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h2>Year : {{ $result['year'] }}</h2>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <h2>Model : {{ $result['model'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h2>Color : {{ $result['color'] }}</h2>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <h2>Mileage : {{ $result['mileage'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h2>Image :</h2>
                                    <img src="{{ url('storage/'.$result['image']) }}" alt="image" height="50" width="50">
                                </div>
                            </div>
                            <div class="col-6">
                                <div><h1>Location :</h1></div>
                                <div id="map" style="height: 300px;"></div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
