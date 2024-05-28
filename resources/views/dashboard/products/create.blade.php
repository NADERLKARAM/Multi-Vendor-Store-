@extends('layouts.master')

@section('title', 'Create Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Products</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Product</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Store ID -->
                            <div class="form-group">
                                <label for="store_id">Store:</label>
                                <select class="form-control" name="store_id" id="store_id">
                                    <option value="">Select Store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('store_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Category ID -->
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" step="0.01" required>
                            </div>

                            <!-- Compare Price -->
                            <div class="form-group">
                                <label for="compare_price">Compare Price:</label>
                                <input type="number" class="form-control" name="compare_price" id="compare_price" value="{{ old('compare_price') }}" step="0.01">
                            </div>

                            <!-- Options -->
                            <div class="form-group">
                                <label for="options">Options:</label>
                                <textarea class="form-control" name="options" id="options">{{ old('options') }}</textarea>
                            </div>

                            <!-- Rating -->
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <input type="number" class="form-control" name="rating" id="rating" value="{{ old('rating') }}" step="0.1" min="0" max="5">
                            </div>

                            <!-- Featured -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="featured" id="featured" {{ old('featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
