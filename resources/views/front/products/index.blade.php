<x-front-layout>





    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Shop Grid</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="/"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)">Shop</a></li>
                        <li>Shop Grid</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
        <div class="single-widget search">
            <h3>Search Product</h3>
            <form action="{{ route('products.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search Here..." value="{{ isset($query) ? $query : '' }}">
                <button type="submit"><i class="lni lni-search-alt"></i></button>
            </form>
        </div>
        <!-- End Single Widget -->
   <!-- Start Single Widget -->
 <div class="single-widget">
    <h3>All Categories</h3>
    <ul class="list">
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('products.byCategory', ['category_id' => $category->id]) }}">{{ $category->name }}</a><span>({{ $category->products_count }})</span>
            </li>
        @endforeach
    </ul>
</div>
<!-- End Single Widget -->

                     <!-- Start Single Widget -->
                     <div class="single-widget condition">
                        <h3>Filter by Price</h3>
                        <form action="{{ isset($category_id) ? route('products.byCategory', ['category_id' => $category_id]) : '#' }}" method="GET">
                            @foreach ($priceRanges as $priceRange)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="price_range" value="{{ $priceRange['value'] }}" id="price_range_{{ $loop->index }}">
                                <label class="form-check-label" for="price_range_{{ $loop->index }}">
                                    {{ $priceRange['range'] }} ({{ $priceRange['count'] }})
                                </label>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </form>
                    </div>
<!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>Filter by Brand</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11">
                                <label class="form-check-label" for="flexCheckDefault11">
                                    Apple (254)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault22">
                                <label class="form-check-label" for="flexCheckDefault22">
                                    Bosh (39)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault33">
                                <label class="form-check-label" for="flexCheckDefault33">
                                    Canon Inc. (128)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault44">
                                <label class="form-check-label" for="flexCheckDefault44">
                                    Dell (310)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault55">
                                <label class="form-check-label" for="flexCheckDefault55">
                                    Hewlett-Packard (42)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault66">
                                <label class="form-check-label" for="flexCheckDefault66">
                                    Hitachi (217)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault77">
                                <label class="form-check-label" for="flexCheckDefault77">
                                    LG Electronics (310)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault88">
                                <label class="form-check-label" for="flexCheckDefault88">
                                    Panasonic (74)
                                </label>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- End Product Sidebar -->
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select class="form-control" id="sorting" onchange="handleSortingChange()">
                                            <option value="popularity">Popularity</option>
                                            <option value="price_asc">Low - High Price</option>
                                            <option value="price_desc">High - Low Price</option>
                                            <option value="rating_desc">Average Rating</option>
                                            <option value="name_asc">A - Z Order</option>
                                            <option value="name_desc">Z - A Order</option>
                                        </select>
                                        <h3 class="total-show-product">Showing: <span>j - 12 items</span></h3>
                                    </div>
                                    @if(isset($category_id))
                                    <input type="hidden" id="categoryId" value="{{ $category_id }}">
                                @endif
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                    class="lni lni-list"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="product-image">
                                                <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                                    <img style="width: 250px; height: 250px; padding: 10px 0px 10px 35px;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                    @if ($product->compare_price && $product->compare_price > $product->price)
                                                        <span class="sale-tag">
                                                            -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                                                        </span>
                                                    @endif
                                                </a>
                                                <div class="button">
                                                    <a href="{{ route('product-details', ['product' => $product->id]) }}" class="btn">
                                                        <i class="lni lni-cart"></i> Add to Cart
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <span class="category">{{ $product->category->name }}</span>
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
                                                    <span>${{ number_format($product->price, 2) }}</span>
                                                    @if ($product->compare_price && $product->compare_price > $product->price)
                                                        <span class="discount-price">${{ number_format($product->compare_price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                 <!-- Pagination -->
<div class="pagination left">
    <ul class="pagination-list">
        <!-- Previous Page Link -->
        @if ($products->previousPageUrl())
            <li><a href="{{ $products->previousPageUrl() }}">&laquo;</a></li>
        @else
            <li class="disabled"><span>&laquo;</span></li>
        @endif

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                <a href="{{ $products->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($products->nextPageUrl())
            <li><a href="{{ $products->nextPageUrl() }}">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</div>
<!--/ End Pagination -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                <div class="row">
                                    @foreach ($products as $product )

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="product-image">
                                                     <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                                    <img style="width: 250px; height: 250px; padding: 10px 0px 10px 35px;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                    @if ($product->compare_price && $product->compare_price > $product->price)
                                                        <span class="sale-tag">
                                                            -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                                                        </span>
                                                    @endif
                                                </a>
                                                        <div class="button">
                                                            <a href="{{ route('product-details', ['product' => $product->id]) }}" class="btn"><i
                                                                    class="lni lni-cart"></i> Add to
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-12">
                                                    <div class="product-info">
                                                        <span class="category">{{ $product->category->name }}</span>
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
                                                            <span>{{ $product->price }}</span>
                                                            <span class="discount-price">{{ $product->compare_price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12">
                  <!-- Pagination -->
<div class="pagination left">
    <ul class="pagination-list">
        <!-- Previous Page Link -->
        @if ($products->previousPageUrl())
            <li><a href="{{ $products->previousPageUrl() }}">&laquo;</a></li>
        @else
            <li class="disabled"><span>&laquo;</span></li>
        @endif

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                <a href="{{ $products->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($products->nextPageUrl())
            <li><a href="{{ $products->nextPageUrl() }}">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</div>
<!--/ End Pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grids -->




    <script>
        function handleSortingChange() {
            var sortingValue = document.getElementById('sorting').value;
            var url = '{{ route("products.byCategory", ["category_id" => ":category_id"]) }}';
            url = url.replace(':category_id', document.getElementById('categoryId').value);
            window.location.href = url + '?sort=' + sortingValue;
        }
    </script>

</x-front-layout>
