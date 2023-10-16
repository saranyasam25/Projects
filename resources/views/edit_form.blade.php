@extends('master')
@section('title', 'Edit Car Details')

@section('main_section')
<div class="create">
    <div class="create_content">
        <div class="container">
            <div class="row pt-2">
                <div class="col-lg-12 d-flex justify-content-between align-items-center mx-auto">
                    <h2>Edit Car Details</h2>
                </div>
            </div>
            <hr class="my-2">
            <div class="row my-3">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-info">
                        <h3 class="text-dark text-center fw-bold">Edit Car</h3>
                    </div>
                    <div class="card-body p-4">
                        @foreach ($results as $result)
                        <form method="post" action="/car-edit-form/{{ $result['id'] }}" enctype="multipart/form-data">
                            @csrf
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="year">Year:</label>
                                <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                                    <option value="{{ $result['year'] }}">{{ $result['year'] }}</option>
                                    @for ($year = date('Y'); $year >= 1970; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="model">Model:</label>
                                <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" placeholder="Model" value="{{ $result['model'] }}">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="color">Color:</label>
                                <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror" placeholder="Color" value="{{ $result['color'] }}">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="mileage">Mileage:</label>
                                <input type="text" name="mileage" id="mileage" class="form-control @error('mileage') is-invalid @enderror" placeholder="Mileage" value="{{ $result['mileage'] }}">
                                @error('mileage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="image">Image:</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ $result['image'] }}">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 pb-2">
                                <label class="fw-bold" for="location">Location:</label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" placeholder="Location" value="{{ $result['location'] }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2 text-center">
                                <input type="submit" value="Edit Car" class="btn btn-primary">
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
