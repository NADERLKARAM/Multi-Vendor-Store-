@extends('layouts.master')

@section('title', 'Create Brands')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Create Brands</li>
@endsection


@section('content')
<div class="container">
    <h1>Add Brand</h1>
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
