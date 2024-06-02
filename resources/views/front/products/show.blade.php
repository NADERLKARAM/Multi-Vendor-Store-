<x-front-layout :title="$product->name">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $product->name }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="/"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Single Product</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>Single Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <a href="/products/{{ $product->id }}"><img
                                        style="max-height:550px;min-height:350px" src="{{ asset('storage/' . $product->image) }}"
                                        alt=""></a>
                                </div>
                                {{-- <div class="images">
                                    <img src="https://via.placeholder.com/1000x670" class="img" alt="#">
                                    <img src="https://via.placeholder.com/1000x670" class="img" alt="#">
                                    <img src="https://via.placeholder.com/1000x670" class="img" alt="#">
                                    <img src="https://via.placeholder.com/1000x670" class="img" alt="#">
                                    <img src="https://via.placeholder.com/1000x670" class="img" alt="#">
                                </div> --}}
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $product->name }}</h2>
                            <p class="category">
                                <i class="lni lni-tag"></i>
                                @if ($product->category)
                                    Drones:<a href="javascript:void(0)">{{ $product->category->name }}</a>
                                @else
                                    No category assigned
                                @endif
                            </p>
                            <h3 class="price">{{ Currency::format($product->price) }}@if($product->compare_price)<span>{{ Currency::format($product->compare_price) }}</span>@endif</h3>
                            <p class="info-text">{{ $product->description }}</p>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group color-option">
                                            <label class="title-label" for="size">Choose color</label>
                                            <div class="single-checkbox checkbox-style-1">
                                                <input type="checkbox" id="checkbox-1" checked>
                                                <label for="checkbox-1"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-2">
                                                <input type="checkbox" id="checkbox-2">
                                                <label for="checkbox-2"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-3">
                                                <input type="checkbox" id="checkbox-3">
                                                <label for="checkbox-3"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-4">
                                                <input type="checkbox" id="checkbox-4">
                                                <label for="checkbox-4"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="color">Battery capacity</label>
                                            <select class="form-control" id="color">
                                                <option>5100 mAh</option>
                                                <option>6200 mAh</option>
                                                <option>8000 mAh</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group quantity">
                                            <label for="color">Quantity</label>
                                            <select class="form-control" name="quantity">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-content">
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
                                                @csrf
                                                <div class="button cart-button">
                                                    <button class="btn" type="submit" style="width: 100%;">Add to Cart</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-12">
                                            <!-- Button for adding/removing to/from wishlist -->
                                            <form id="wishlistForm-{{ $product->id }}" class="wishlistForm" action="{{ route('wishlist.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="wish-button">
                                                    <button id="wishlistButton-{{ $product->id }}" class="btn btn-primary"><i class="lni lni-heart"></i> To Wishlist</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block"></div>
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="single-block give-review">
                            @php
                                // Calculate overall rating and count of each star
                                $overallRating = $product->reviews->avg('rating');
                                $starCounts = $product->reviews->groupBy('rating')->map->count();
                            @endphp

                            <h4>{{ number_format($overallRating, 1) }} (Overall)</h4>
                            <ul>
                                @for ($i = 5; $i >= 1; $i--)
                                    <li>
                                        <span>{{ $i }} stars - {{ $starCounts[$i] ?? 0 }}</span>
                                        @for ($j = 1; $j <= 5; $j++)
                                            <i class="lni {{ $j <= $i ? 'lni-star-filled' : 'lni-star' }}"></i>
                                        @endfor
                                    </li>
                                @endfor
                            </ul>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn review-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Leave a Review
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="single-block">
                            <div class="reviews">
                                <h4 class="title">Latest Reviews</h4>
                                @foreach ($product->reviews as $review)
                                    <div class="single-review">
                                        <img src="https://via.placeholder.com/150x150" alt="#">
                                        <div class="review-info">
                                            <h4>{{ $review->subject }}
                                                <span>{{ $review->name }}</span>
                                            </h4>
                                            <ul class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li><i class="lni {{ $i <= $review->rating ? 'lni-star-filled' : 'lni-star' }}"></i></li>
                                                @endfor
                                            </ul>
                                            <p>{{ $review->message }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Item Details -->

<!-- Review Modal -->
<div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.reviews.store', ['product' => $product->id]) }}" method="POST" id="review-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-name">Your Name</label>
                                <input class="form-control" type="text" id="review-name" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-email">Your Email</label>
                                <input class="form-control" type="email" id="review-email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-subject">Subject</label>
                                <input class="form-control" type="text" id="review-subject" name="subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select class="form-control" id="review-rating" name="rating" required>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" name="message" rows="8" required></textarea>
                    </div>
                    <div class="modal-footer button">
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Review Modal -->

<!-- Error Messages -->
@if ($errors->any())
    <div id="review-errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</x-front-layout>
