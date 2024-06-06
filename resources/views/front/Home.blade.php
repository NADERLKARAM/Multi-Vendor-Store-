<x-front-layout>


    <!-- Start Featured Categories Area -->
    <section class="featured-categories section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Featured Categories') }}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category )
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">{{ $category->name }}</h3>
                        <ul>
                            @foreach ($category->products->take(4) as $product)
                            <li><a href="{{ route('product-details', ['product' => $product->id]) }}">{{ $product->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('products.byCategory', $category->id) }}">View All</a></li>
                        </ul>
                        <div class="images">
                            <img  style="width: 200px; height: 185px; padding-right: 30px;" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Features Area -->

<!-- Start Trending Product Area -->
<section class="trending-product section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>{{ __('Trending Product') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products->take(8) as $product)
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image">
                        <a href="/products/{{ $product->id }}">
                            <img style="width: 250px; height: 250px; padding: 10px 0px 10px 35px;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @if ($product->compare_price && $product->compare_price > $product->price)
                                                <span class="sale-tag">
                                                    -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                                                </span>
                            @endif
                        </a>
                        <div class="button">
                            <a href="{{ route('product-details', ['product' => $product->id]) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-info">
                        @if ($product->category)
                        <a href="javascript:void(0)">{{ $product->category->name }}</a>
                        @else
                        <span>No category assigned</span>
                        @endif
                        <h4 class="title">
                            <a href="{{ route('product-details', ['product' => $product->id]) }}">{{ $product->name }}</a>
                        </h4>
                    @php
                        $averageRating = $product->reviews->avg('rating');
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
                        <div class="price">
                            <span>${{ $product->price }}</span>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Trending Product Area -->



    {{-- <!-- Start Special Offer -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Special Offer</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/335x335" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Camera</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">WiFi Security Camera</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>5.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$399.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/335x335" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Laptop</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">Apple MacBook Air</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>5.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$899.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/335x335" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Speaker</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">Bluetooth Speaker</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star"></i></li>
                                        <li><span>4.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$70.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                    </div>
                    <!-- Start Banner -->
                    <div class="single-banner right"
                        style="background-image:url('https://via.placeholder.com/730x310');margin-top: 30px;">
                        <div class="content">
                            <h2>Samsung Notebook 9 </h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                incididunt ut labore.</p>
                            <div class="price">
                                <span>$590.00</span>
                            </div>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="offer-content">
                        <div class="image">
                            <img src="https://via.placeholder.com/510x600" alt="#">
                            <span class="sale-tag">-50%</span>
                        </div>
                        <div class="text">
                            <h2><a href="product-grids.html">Bluetooth Headphone</a></h2>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                <span>$200.00</span>
                                <span class="discount-price">$400.00</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry incididunt ut
                                eiusmod tempor labores.</p>
                        </div>
                        <div class="box-head">
                            <div class="box">
                                <h1 id="days">000</h1>
                                <h2 id="daystxt">Days</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">00</h1>
                                <h2 id="hourstxt">Hours</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">00</h1>
                                <h2 id="minutestxt">Minutes</h2>
                            </div>
                            <div class="box">
                                <h1 id="seconds">00</h1>
                                <h2 id="secondstxt">Secondes</h2>
                            </div>
                        </div>
                        <div style="background: rgb(204, 24, 24);" class="alert">
                            <h1 style="padding: 50px 80px;color: white;">We are sorry, Event ended ! </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Special Offer --> --}}

    <!-- Start Home Product List -->
    <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>
                    @foreach ($bestSellingProducts as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product-details', ['product' => $product->id]) }}">{{ $product->name }}</a>
                                </h3>
                                <span>${{ $product->price }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">New Arrivals</h4>
                    @foreach ($newArrivals as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product-details', ['product' => $product->id]) }}">{{ $product->name }}</a>
                                </h3>
                                <span>${{ $product->price }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>
                    @foreach ($topRatedProducts->take(3) as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product-details', ['product' => $product->id]) }}">{{ $product->name }}</a>
                                </h3>
                                <span>${{ $product->price }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Home Product List -->

    {{-- !-- Start Brands Area --> --}}
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Popular Brands</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    @foreach($brands as $brand)
                        <div class="brand-logo">
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}">
                            @else
                                <img src="https://via.placeholder.com/220x160" alt="Placeholder">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Brands Area -->




</x-front-layout>
