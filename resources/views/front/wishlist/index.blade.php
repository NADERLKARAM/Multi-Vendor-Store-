<x-front-layout>
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="wishlist">
                        <div class="title">
                            <h3>Your Wishlist</h3>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($wishlists->isEmpty())
                            <p>Your wishlist is empty.</p>
                        @else
                            <div class="row">
                                @foreach ($wishlists as $wishlist)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="single-product">
                                            <div class="product-image">
                                                <a href="{{ route('product-details', ['product' => $wishlist->product->id]) }}">
                                                    <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $wishlist->product->image) }}" alt="{{ $wishlist->product->name }}">
                                                    @if ($wishlist->product->compare_price && $wishlist->product->compare_price > $wishlist->product->price)
                                                        <span class="sale-tag">
                                                            -{{ round((($wishlist->product->compare_price - $wishlist->product->price) / $wishlist->product->compare_price) * 100) }}%
                                                        </span>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h4 class="title">
                                                    <a href="{{ route('product-details', ['product' => $wishlist->product->id]) }}">{{ $wishlist->product->name }}</a>
                                                </h4>
                                                <p>Category:
                                                    @if ($wishlist->product->category)
                                                        <a href="javascript:void(0)">{{ $wishlist->product->category->name }}</a>
                                                    @else
                                                        <span>No category assigned</span>
                                                    @endif
                                                </p>
                                                <p>Rating:
                                                @php
                                                    $averageRating = $wishlist->product->reviews->avg('rating');
                                                @endphp

                                                <ul class="review">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $averageRating)
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                        @else
                                                            <li><i class="lni lni-star"></i></li>
                                                        @endif
                                                    @endfor
                                                    <li><span>{{ number_format($averageRating, 1) }} Review(s)</span></li>
                                                </ul>
                                                </p>
                                                <p>Price: <span>${{ $wishlist->product->price }}</span></p>
                                                <div class="button">
                                                    <div class="button">
                                                        <a href="{{ route('product-details', ['product' => $wishlist->product->id]) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-group">
                                                <!-- Button for removing from wishlist -->
                                                <form id="removeFromWishlistForm" action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="removeFromWishlist" type="submit" class="btn btn-sm btn-danger">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
