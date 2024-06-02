@extends('layouts.master')

@section('title', 'Brands')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Brands</li>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="mb-5">
    <a href="{{ route('brands.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
</div>

<div class="mb-3">
    <form action="{{ route('brands.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search brands" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

<!-- Ordering Controls -->
<div class="mb-3">
    <strong>Order by:</strong>
    <form action="{{ route('brands.index') }}" method="GET" class="form-inline">
        <div class="input-group">
            <select class="form-control" name="order_by">
                <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Created At</option>
            </select>
            <select class="form-control" name="order_direction">
                <option value="asc" {{ request('order_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Apply</button>
            </div>
        </div>
    </form>
</div>


<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @forelse($brands as $brand)
        <tr>
            <td>
                @if ($brand->image)
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" height="50">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</a></td>
            <td>
                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form id="delete-form-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    <input type="hidden" name="_method" value="delete">
                    @method('delete')
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $brand->id }}')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No brands defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

 <!-- Custom Pagination Links -->
 {{ $brands->links('vendor.pagination.custom') }}


<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this brand?')) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    }
</script>



@endsection
