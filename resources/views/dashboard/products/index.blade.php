@extends('layouts.master')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection


@section('content')

<div class="mb-5">
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
</div>

<div class="mb-3">
    <form action="{{ route('products.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search products" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

<!-- Ordering Controls -->
<div class="mb-3">
    <strong>Order by:</strong>
    <form action="{{ route('products.index') }}" method="GET" class="form-inline">
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
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>
                @if($product->category)
                    {{ $product->category->name }}
                @else
                    No Category Assigned
                @endif
            </td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('products.destroy', $product) }}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    <input type="hidden" name="_method" value="delete">
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No products defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

 <!-- Custom Pagination Links -->
 {{ $products->links('vendor.pagination.custom') }}

@endsection
