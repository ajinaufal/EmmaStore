@extends("template",['etalase'=>$etalase])

@section('page_title', 'Tentang Kami')
@section('meta_desc', 'Di DebiruHouse, kami menjual PARFUM ORIGINAL & produk perawatan tubuh lainnya')
@section('meta_keywords', 'about us, mengenai kami, tentang kami')

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>etalase</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{ $products[0]->etalase }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section class="section-big-pt-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="top-banner-wrapper">
                                        <a href="product-page(left-sidebar).html"><img src="../assets/images/category/1.jpg"
                                                class="img-fluid  w-100" alt=""></a>
                                        <div class="top-banner-content small-section">
                                            <h4>fashion</h4>
                                            <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            </h5>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since the
                                                1500s, when an unknown printer took a galley of type and scrambled it to
                                                make a type specimen book. It has survived not only five centuries, but also
                                                the leap into electronic typesetting, remaining essentially unchanged. It
                                                was popularised in the 1960s with the release of Letraset sheets containing
                                                Lorem Ipsum passages, and more recently with desktop publishing software
                                                like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                        </div>
                                    </div>
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="filter-main-btn ">
                                                            <span class="filter-btn ">
                                                                <i class="fa fa-filter" aria-hidden="true"></i> Filter
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 position-relative">
                                                        <div class="product-filter-content horizontal-filter-mian ">
                                                            <div class="horizontal-filter-toggle">
                                                                <h4><i data-feather="filter"></i>letest filter</h4>
                                                            </div>
                                                            <div class="collection-view">
                                                                <ul>
                                                                    <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                    <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="collection-grid-view">
                                                                <ul>
                                                                    <li><img src="../assets/images/category/icon/2.png"
                                                                            alt="" class="product-2-layout-view"></li>
                                                                    <li><img src="../assets/images/category/icon/3.png"
                                                                            alt="" class="product-3-layout-view"></li>
                                                                    <li><img src="../assets/images/category/icon/4.png"
                                                                            alt="" class="product-4-layout-view"></li>
                                                                    <li><img src="../assets/images/category/icon/6.png"
                                                                            alt="" class="product-6-layout-view"></li>
                                                                </ul>
                                                            </div>
                                                            <div class="product-page-per-view">
                                                                <select>
                                                                    <option value="High to low">24 Produk Per Halaman
                                                                    </option>
                                                                    <option value="Low to High">50 Produk Per Halaman
                                                                    </option>
                                                                    <option value="Low to High">100 Produk Per Halaman
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="product-page-filter ">
                                                                <select>
                                                                    <option value="High to low">Sorting items</option>
                                                                    <option value="Low to High">50 Produk</option>
                                                                    <option value="Low to High">100 Produk</option>
                                                                </select>
                                                            </div>
                                                            <div class="horizontal-filter collection-filter">
                                                                <div class="horizontal-filter-contain">
                                                                    <div class="collection-mobile-back"><span
                                                                            class="filter-back"><i
                                                                                class="fa fa-angle-left"
                                                                                aria-hidden="true"></i> back</span></div>
                                                                    <div class="filter-group">
                                                                        <div class="collection-collapse-block">
                                                                            <h6 class="collapse-block-title">select color
                                                                            </h6>
                                                                            <div class="collection-collapse-block-content">
                                                                                <div class="color-selector">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="color-1 active">
                                                                                            </div> white (14)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-2">
                                                                                            </div> brown(24)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-3">
                                                                                            </div> red(18)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-4">
                                                                                            </div> purple(10)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-5">
                                                                                            </div> teal(9)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-6">
                                                                                            </div> pink(11)
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="color-7">
                                                                                            </div> coral(15)
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-group">
                                                                        <div class="collection-collapse-block">
                                                                            <h6 class="collapse-block-title">select color
                                                                            </h6>
                                                                            <div class="collection-collapse-block-content">
                                                                                <div class="size-selector">
                                                                                    <div class="collection-brand-filter">
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="xssmall">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="xssmall">xs</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="small">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="small">s</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="mediam">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="mediam">m</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="large">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="large">l</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="extralarge">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="extralarge">xl</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="2extralarge">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="2extralarge">2xl</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-group">
                                                                        <div class="collection-collapse-block">
                                                                            <h6 class="collapse-block-title">select price
                                                                            </h6>
                                                                            <div class="collection-collapse-block-content">
                                                                                <div class="size-selector">
                                                                                    <div class="collection-brand-filter">
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="hundred">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="hundred">$10 -
                                                                                                $100</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="twohundred">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="twohundred">$100 -
                                                                                                $200</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="threehundred">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="threehundred">$200 -
                                                                                                $300</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="fourhundred">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="fourhundred">$300 -
                                                                                                $400</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input form-check-input"
                                                                                                id="fourhundredabove">
                                                                                            <label
                                                                                                class="custom-control-label form-check-label"
                                                                                                for="fourhundredabove">$400
                                                                                                above</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-group">
                                                                        <div class="collection-collapse-block">
                                                                            <h6 class="collapse-block-title">select brand
                                                                            </h6>
                                                                            <div class="collection-collapse-block-content">
                                                                                <div class="collection-brand-filter">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input form-check-input"
                                                                                            id="zara">
                                                                                        <label
                                                                                            class="custom-control-label form-check-label"
                                                                                            for="zara">zara</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input form-check-input"
                                                                                            id="vera-moda">
                                                                                        <label
                                                                                            class="custom-control-label form-check-label"
                                                                                            for="vera-moda">vera-moda</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input form-check-input"
                                                                                            id="forever-21">
                                                                                        <label
                                                                                            class="custom-control-label form-check-label"
                                                                                            for="forever-21">forever-21</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input form-check-input"
                                                                                            id="roadster">
                                                                                        <label
                                                                                            class="custom-control-label form-check-label"
                                                                                            for="roadster">roadster</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input form-check-input"
                                                                                            id="only">
                                                                                        <label
                                                                                            class="custom-control-label form-check-label"
                                                                                            for="only">only</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-solid btn-sm close-filter"> close
                                                                    filter</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-wrapper-grid product">
                                            <div class="row">
                                                @foreach ($products as $p)
                                                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 col-grid-box">
                                                        <div class="product-box">
                                                            <div class="product-imgbox">
                                                                <div class="product-front">
                                                                    <a href="/detail/{{ $p->id }}"> <img
                                                                            src="/assets/images/products/parfum/{{ $p->gambar1 }}"
                                                                            class="img-fluid  " alt="product"> </a>
                                                                </div>
                                                                <div class="product-back">
                                                                    <a href="/detail/{{ $p->id }}"> <img
                                                                            src="/assets/images/products/parfum/{{ $p->gambar1 }}"
                                                                            class="img-fluid  " alt="product"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="product-detail detail-center detail-inverse">
                                                                <div class="detail-title">
                                                                    <div class="detail-left">
                                                                        <div class="rating-star"> <i
                                                                                class="fa fa-star"></i> <i
                                                                                class="fa fa-star"></i> <i
                                                                                class="fa fa-star"></i> <i
                                                                                class="fa fa-star"></i> <i
                                                                                class="fa fa-star"></i> </div>
                                                                        <p>Lorem Ipsum is simply dummy text of the printing
                                                                            and typesetting industry. Lorem Ipsum has been
                                                                            the industry's standard dummy text ever since
                                                                            the 1500s, when an unknown printer took a galley
                                                                            of type and scrambled it to make a type specimen
                                                                            book</p>
                                                                        <a href="/detail/{{ $p->id }}">
                                                                            <h6 class="price-title">
                                                                                {{ $p->nama }}
                                                                            </h6>
                                                                        </a>
                                                                    </div>
                                                                    <div class="detail-right">
                                                                        <?php if($p->onsale > 0) { ?>
                                                                        <div class="check-price"> Rp.
                                                                            {{ number_format($p->harga) }} </div>
                                                                        <div class="price">
                                                                            <div class="price"> Rp.
                                                                                {{ number_format($p->onsale) }} </div>
                                                                        </div>
                                                                        <?php } else { ?>
                                                                        <div class="price">
                                                                            <div class="price"> Rp.
                                                                                {{ number_format($p->harga) }} </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="icon-detail">
                                                                    @if (Auth::check())
                                                                        <button id="button_cart" 
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#addtocart"
                                                                            data-user_id="{{ auth()->user()->id }}"
                                                                            data-id="{{ $p->id }}"
                                                                            data-name="{{ $p->nama }}"
                                                                            data-harga="{{ $p->harga }}"
                                                                            data-gambar="{{ $p->gambar1 }}"
                                                                            class="tooltip-top"
                                                                            data-tippy-content="Add to cart">
                                                                            <i data-feather="shopping-cart"></i>
                                                                        </button>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                            onclick="openAccount()">
                                                                            <i data-feather="shopping-cart"></i>
                                                                        </a>
                                                                    @endif
                                                                    <a href="javascript:void(0)"
                                                                        class="add-to-wish tooltip-top"
                                                                        data-tippy-content="Add to Wishlist"> <i
                                                                            data-feather="heart"></i> </a>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#quick-view"
                                                                        data-id="{{ $p->id }}"
                                                                        class="quick-view tooltip-top"
                                                                        data-tippy-content="Quick View"> <i
                                                                            data-feather="eye"></i> </a>
                                                                    <a href="compare.html" class="tooltip-top"
                                                                        data-tippy-content="Compare">
                                                                        <i data-feather="refresh-cw"></i> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-pagination">
                                        <div class="theme-paggination-block">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination">
                                                                <?php if($cur_page > 1) { ?>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="/etalase/{{ $etalase_name }}/{{ $cur_page - 1 }}"
                                                                        aria-label="Previous"><span aria-hidden="true"><i
                                                                                class="fa fa-chevron-left"
                                                                                aria-hidden="true"></i></span>
                                                                        <span class="sr-only">Previous</span></a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php for($i=1; $i<=$total_pages;$i++) { ?>
                                                                <li class="page-item "><a class="page-link"
                                                                        href="/etalase/{{ $etalase_name }}/{{ $i }}">{{ $i }}</a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($cur_page < $total_pages-1) { ?>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="/etalase/{{ $etalase_name }}/{{ $cur_page + 1 }}"
                                                                        aria-label="Next"><span aria-hidden="true"><i
                                                                                class="fa fa-chevron-right"
                                                                                aria-hidden="true"></i></span>
                                                                        <span class="sr-only">Next</span></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <div class="product-search-count-bottom">
                                                            <h5>Showing Products {{ $first_offset }} -
                                                                {{ $last_offset }}
                                                                of {{ $total_products }} Result</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- section End -->

@endsection
