@extends('layouts.master')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="mb-5">
    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    <a href="{{ route('categories.trash') }}" class="btn btn-sm btn-outline-secondary">View Trashed Categories</a>
</div>

<div class="mb-3">
    <form action="{{ route('categories.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search categories" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

<!-- Ordering Controls -->
<div class="mb-3">
    <strong>Order by:</strong>
    <form action="{{ route('categories.index') }}" method="GET" class="form-inline">
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
            <th>Description</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" height="50">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $category->id }}</td>
            <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->parent_name}}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    <input type="hidden" name="_method" value="delete">
                    @method('delete')
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $category->id }}')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No categories defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination links -->
{{ $categories->links() }}



<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    }
</script>



@endsection
