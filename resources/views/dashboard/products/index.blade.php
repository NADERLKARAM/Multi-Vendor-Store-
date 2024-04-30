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


<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Store</th>
            <th>Description</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>

            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->description }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No Products defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>






@endsection
