@extends('layouts.master')

@section('title', 'Trashed Categories')

@section('content')

<h1>Trashed Categories</h1>

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Deleted At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($trashedCategories as $category)
        <tr>
            <td>
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" height="50">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->deleted_at }}</td>
            <td>
                <form action="{{ route('categories.restore', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                </form>
                <form action="{{ route('categories.force-delete', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No trashed categories found</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
