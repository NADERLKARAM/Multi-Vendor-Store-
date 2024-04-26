@extends('layouts.master')

@section('title', 'Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')


    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            <span class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="parent_id">Category Parent</label>
            <select name="parent_id" class="form-control">
                <option value="">Primary Category</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>

            <span class="text-danger">
                @error('parent_id')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

            <span class="text-danger">
                @error('description')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <span class="text-danger">
                @error('image')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            <span class="text-danger">
                @error('status')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>

@endsection
