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
                                @error('store_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" step="0.01" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Compare Price -->
                            <div class="form-group">
                                <label for="compare_price">Compare Price:</label>
                                <input type="number" class="form-control" name="compare_price" id="compare_price" value="{{ old('compare_price') }}" step="0.01">
                                @error('compare_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Options -->
                            <div class="form-group">
                                <label for="options">Options:</label>
                                <textarea class="form-control" name="options" id="options">{{ old('options') }}</textarea>
                                @error('options')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <input type="number" class="form-control" name="rating" id="rating" value="{{ old('rating') }}" step="0.1" min="0" max="5">
                                @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="featured" id="featured" {{ old('featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured</label>
                                @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <input class="form-control" name="tags" id="tagInput" placeholder="Enter tags" value="{{ old('tags') }}">
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </form>

                        @push('styles')
                        <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
                        @endpush

                        @push('scripts')
                        <script src="{{ asset('js/tagify.min.js') }}"></script>
                        <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
                        <script>
                            var inputElm = document.querySelector('[name=tags]'),
                            tagify = new Tagify (inputElm);
                        </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
