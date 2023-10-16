@extends('master')
@section('title', 'DashBoard')

@section('main_section')
<div class="container">
    {{-- < ?php dd(Auth::User());?> --}}
    <div class="text-center">
        <h3>Car List</h3>
    </div>
    <div class="filter row pt-3 pb-3">
        <?php
        $role = Auth::user()['role'];
        ?>
        @if ($role == 'Admin' || $role == 'Member')
        <div class="text-end">
            <button class="btn btn-warning"><a href="/car-form" class="text-decoration-none text-dark">Add New Car</a></button>
        </div>
        @endif
    </div>
    <div class="table table-responsive fixTableHead first_content">
        <table id="example" class="table table-borderless">
            <thead>
                <tr>
                    <th class="ps-3 pe-0 align-middle">Year</th>
                    <th class="ps-0 pe-0 align-middle">Model</th>
                    <th class="ps-0 pe-0 align-middle">Mileage</th>
                    <th class="ps-0 pe-0 align-middle">Color</th>
                    <th class="ps-0 pe-0 align-middle">Action</th>
                </tr>
            </thead>
            <tbody>
                @isset($datas)
                @foreach ($datas as $data)
                    <tr>
                        <td class="ps-3 pe-0 align-middle">{{ $data['year'] }}</td>
                        <td class="ps-3 pe-0 align-middle">{{ $data['model'] }}</td>
                        <td class="ps-3 pe-0 align-middle">{{ $data['mileage'] }}</td>
                        <td class="ps-3 pe-0 align-middle">{{ $data['color'] }}</td>
                        <td class="ps-3 pe-0 align-middle">
                            @if ($role == 'Admin')
                                <a href="/car-edit/{{ $data['id'] }}" class="p-2" data-id="{{ $data['id'] }}"><i class="fas fa-edit"></i></a>
                                <a href="" class="p-2 delete-icon" data-id="{{ $data['id'] }}"><i class="fas fa-trash-alt"></i></a>
                                <a href="/car-view/{{ $data['id'] }}" class="p-2 view-icon" data-id="{{ $data['id'] }}"><i class="far fa-eye"></i></a>
                            @elseif ($role == 'Member' || $role == 'User')
                                <a href="/car-view/{{ $data['id'] }}" class="p-2 view-icon" data-id="{{ $data['id'] }}"><i class="far fa-eye"></i></a>
                            @endif
                        </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>
@endsection
