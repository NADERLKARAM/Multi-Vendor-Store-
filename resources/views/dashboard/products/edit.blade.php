@extends('layouts.master')

@section('title', 'Update Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Update Product</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Product</div>

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

                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Store ID -->
                            <div class="form-group">
                                <label for="store_id">Store:</label>
                                <select class="form-control" name="store_id" id="store_id">
                                    <option value="">Select Store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ $product->store_id == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Category ID -->
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" required>{{ $product->description }}</textarea>
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="max-width: 200px;">
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $product->price }}" step="0.01" required>
                            </div>

                            <!-- Compare Price -->
                            <div class="form-group">
                                <label for="compare_price">Compare Price:</label>
                                <input type="number" class="form-control" name="compare_price" id="compare_price" value="{{ $product->compare_price }}" step="0.01">
                            </div>

                            <!-- Options -->
                            <div class="form-group">
                                <label for="options">Options:</label>
                                <textarea class="form-control" name="options" id="options">{{ $product->options }}</textarea>
                            </div>

                            <!-- Rating -->
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <input type="number" class="form-control" name="rating" id="rating" value="{{ $product->rating }}" step="0.1" min="0" max="5">
                            </div>

                            <!-- Featured -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="featured" id="featured" {{ $product->featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ $product->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <!-- Tags -->
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <input class="form-control" name="tags" id="tagInput" placeholder="Enter tags" value="{{ $product->tags }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('scripts')
        <script src="{{ asset('js/tagify.min.js') }}"></script>
        <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
        <script>
            var inputElm = document.querySelector('[name=tags]'),
                tagify = new Tagify(inputElm);
        </script>
    @endpush
@endsection
