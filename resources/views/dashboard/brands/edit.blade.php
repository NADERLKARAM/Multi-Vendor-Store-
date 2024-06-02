@extends('layouts.master')

@section('title', 'Brands')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Brands</li>
@endsection


@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occurred</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Brand Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $brand->name) }}">

        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection

