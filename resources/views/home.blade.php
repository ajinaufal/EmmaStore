@extends("template",['etalase'=>$etalase])

@section('page_title', 'Jual Parfum Original Murah | DebiruHouse')
@section('meta_desc', 'DebiruHouse adalah toko online yang menjual parfum original dengan harga murah')
@section('meta_keywords',
    'parfum, parfum original, jual parfum, parfum murah, parfum pria, parfum wanita, harga parfum,
    toko parfum',)


@section('content')
    {{-- <p> mana @if (Hash::check('147852369', '$2y$10$gIbx.ytBhwFUAOKyZTdwZOO4FKi4kQzt5dm1K4Resw9JWk0PvEo4W')) berhasil @endif</p> --}}
    <!--slider start-->
    <section class="theme-slider layout-5 home-slide">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="slide-1 no-arrow">
                        @if ($slide_image)
                            @foreach ($slide_image as $slide)
                                <div>
                                    <div class="slider-banner slide-banner-4">
                                        <img src="{{ $slide }}" class="img-fluid" alt="slider">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--slider end-->


    <!-- media banner tab start-->
    <section class=" ratio_square section-big-mt-space">
        <div class="custom-container b-g-white section-pb-space">
            <div class="row">
                <div class="col p-0">
                    <div class="theme-tab product">
                        <ul class="tabs tab-title media-tab">
                            <li class="current"><a href="tab-7">on sale</a></li>
                            <li class=""><a href="tab-8">new stuff</a></li>
                        </ul>
                        <div class="tab-content-cls">
                            <!-- ON SALE -->
                            <div id="tab-7" class="tab-content active default ">
                                <div class="media-slide-5 product-m no-arrow">
                                    @for ($i = 0; $i < $total_column_onsale; $i++)
                                        <div>
                                            <div class="media-banner media-banner-1 border-0">
                                                @for ($j = 0; $j < $total_row_onsale; $j++)
                                                    <?php if(!empty($onsale[($j*5)+$i]->nama)) { ?>
                                                    <div class="media-banner-box">
                                                        <div class="media">
                                                            <a href="/detail/{{ $onsale[$j * 5 + $i]->id }}">
                                                                <img src="/assets/images/products/parfum/{{ $onsale[$j * 5 + $i]->gambar1 }}"
                                                                    class="img-fluid " alt="banner"
                                                                    style="width:100px;">
                                                            </a>
                                                            <div class="media-body">
                                                                <div class="media-contant">
                                                                    <div>
                                                                        <div class="product-detail">
                                                                            <ul class="rating">
                                                                                <li><i class="fa fa-star"></i></li>
                                                                                <li><i class="fa fa-star"></i></li>
                                                                                <li><i class="fa fa-star"></i></li>
                                                                                <li><i class="fa fa-star"></i></li>
                                                                                <li><i class="fa fa-star-o"></i></li>
                                                                            </ul>
                                                                            <a
                                                                                href="/detail/{{ $onsale[$j * 5 + $i]->id }}">
                                                                                <p>{{ $onsale[$j * 5 + $i]->nama }}</p>
                                                                            </a>
                                                                            <h6>Rp.
                                                                                {{ number_format($onsale[$j * 5 + $i]->onsale) . '.00' }}<br /><span>Rp.
                                                                                    {{ number_format($onsale[$j * 5 + $i]->harga) . '.00' }}</span>
                                                                            </h6>
                                                                        </div>
                                                                        <div class="cart-info">
                                                                            @if (Auth::check())
                                                                                <a id="button_cart" data-bs-toggle="modal"
                                                                                    data-bs-target="#addtocart"
                                                                                    data-user_id="{{ auth()->user()->id }}"
                                                                                    data-id="{{ $onsale[$j * 5 + $i]->id }}"
                                                                                    data-name="{{ $onsale[$j * 5 + $i]->nama }}"
                                                                                    data-harga="{{ $onsale[$j * 5 + $i]->harga }}"
                                                                                    data-gambar="{{ $onsale[$j * 5 + $i]->gambar1 }}"
                                                                                    class="tooltip-top open-AddtoCart"
                                                                                    data-tippy-content="Add to cart">
                                                                                    <i data-feather="shopping-cart"></i>
                                                                                </a>
                                                                            @else
                                                                                <a href="javascript:void(0)"
                                                                                    onclick="openAccount()">
                                                                                    <i data-feather="shopping-cart"></i>
                                                                                </a>
                                                                            @endif
                                                                            <a href="javascript:void(0)"
                                                                                class="add-to-wish tooltip-top"
                                                                                data-tippy-content="Add to Wishlist"><i
                                                                                    data-feather="heart"
                                                                                    class="add-to-wish"></i></a>
                                                                            <a href="javascript:void(0)"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#quick-view"
                                                                                data-id="{{ $onsale[$j * 5 + $i]->id }}"
                                                                                class="quick-view tooltip-top"
                                                                                data-tippy-content="Quick View"><i
                                                                                    data-feather="eye"></i></a>
                                                                            <a href="compare.html" class="tooltip-top"
                                                                                data-tippy-content="Compare"><i
                                                                                    data-feather="refresh-cw"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <!-- END OF ON SALE -->
                                <!-- NEW STUFF -->
                                <div id="tab-8" class="tab-content ">
                                    <div class="media-slide-5 product-m no-arrow">
                                        @for ($i = 0; $i < $total_column_newstuff; $i++)
                                            <div>
                                                <div class="media-banner media-banner-1 border-0">
                                                    @for ($j = 0; $j < $total_row_newstuff; $j++)
                                                        <?php if(!empty($newstuff[($j*5)+$i]->nama)) { ?>
                                                        <div class="media-banner-box">
                                                            <div class="media">
                                                                <a href="/detail/{{ $newstuff[$j * 5 + $i]->id }}">
                                                                    <img src="/assets/images/products/parfum/{{ $newstuff[$j * 5 + $i]->gambar1 }}"
                                                                        class="img-fluid " alt="banner"
                                                                        style="width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    <div class="media-contant">
                                                                        <div>
                                                                            <div class="product-detail">
                                                                                <ul class="rating">
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                                </ul>
                                                                                <a
                                                                                    href="/detail/{{ $newstuff[$j * 5 + $i]->id }}">
                                                                                    <p>{{ $newstuff[$j * 5 + $i]->nama }}
                                                                                    </p>
                                                                                </a>
                                                                                <?php if($newstuff[($j*5)+$i]->onsale > 0) { ?>
                                                                                <h6>Rp.
                                                                                    {{ number_format($newstuff[$j * 5 + $i]->onsale) . '.00' }}<br /><span>Rp.
                                                                                        {{ number_format($newstuff[$j * 5 + $i]->harga) . '.00' }}</span>
                                                                                </h6>
                                                                                <?php } else { ?>
                                                                                <h6>Rp.
                                                                                    {{ number_format($newstuff[$j * 5 + $i]->harga) . '.00' }}
                                                                                </h6>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="cart-info">
                                                                                @if (Auth::check())
                                                                                    <a id="button_cart"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#addtocart"
                                                                                        data-user_id="{{ auth()->user()->id }}"
                                                                                        data-id="{{ $newstuff[$j * 5 + $i]->id }}"
                                                                                        data-name="{{ $newstuff[$j * 5 + $i]->nama }}"
                                                                                        data-harga="{{ $newstuff[$j * 5 + $i]->harga }}"
                                                                                        data-gambar="{{ $newstuff[$j * 5 + $i]->gambar1 }}"
                                                                                        class="tooltip-top open-AddtoCart"
                                                                                        data-tippy-content="Add to cart">
                                                                                        <i data-feather="shopping-cart"></i>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="javascript:void(0)"
                                                                                        onclick="openAccount()">
                                                                                        <i data-feather="shopping-cart"></i>
                                                                                    </a>
                                                                                @endif
                                                                                <a href="javascript:void(0)"
                                                                                    class="add-to-wish tooltip-top"
                                                                                    data-tippy-content="Add to Wishlist"><i
                                                                                        data-feather="heart"
                                                                                        class="add-to-wish"></i></a>
                                                                                <a href="javascript:void(0)"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#quick-view"
                                                                                    data-id="{{ $newstuff[$j * 5 + $i]->id }}"
                                                                                    class="quick-view tooltip-top"
                                                                                    data-tippy-content="Quick View"><i
                                                                                        data-feather="eye"></i></a>
                                                                                <a href="compare.html"
                                                                                    class="tooltip-top"
                                                                                    data-tippy-content="Compare"><i
                                                                                        data-feather="refresh-cw"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <!-- END OF NEW STUFF-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- media banner tab end -->

    <!--deal banner start-->
    <section class="deal-banner section-big-mt-space deal-banner-inverse">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="deal-banner-containe">
                        <h2>
                            save up to 30% to 40% off
                        </h2>
                        <h1>
                            omg! just look at the great deals!
                        </h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 ">
                    <div class="deal-banner-containe">
                        <diV class="deal-btn">
                            <a href="category-page(left-sidebar).html" class="btn-white">
                                View more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--deal banner end-->

    <!--tab product-->
    <section class="section-pt-space">
        <div class="tab-product-main">
            <div class="tab-prodcut-contain">
                <ul class="tabs tab-title">
                    <?php $i = 1; ?>
                    @foreach ($etalase as $et)
                        <li class="<?php if ($i == 1) {
    echo 'current';
} ?>"></li>
                        <a href="tab-{{ $i }}">{{ $et->etalase }}</a></li>
                        <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--tab product-->

    <!-- slider tab  -->
    <section class="section-py-space ratio_square product">
        <div class="custom-container">
            <div class="row">
                <div class="col pr-0">
                    <div class="theme-tab product">
                        <div class="tab-content-cls ">
                            <?php $j = 1; ?>
                            @foreach ($etalase as $et)
                                <div id="tab-{{ $j }}" class="tab-content <?php if ($j == 1) {
    echo 'active default';
} ?>">
                                    <div class="product-slide-6  product-m  no-arrow">
                                        @foreach ($top_5_etalase[$et->etalase] as $top5)
                                            <div>
                                                <div class="product-box">
                                                    <div class="product-imgbox">
                                                        <div class="product-front">
                                                            <a href="/detail/{{ $top5->id }}">
                                                                <img src="/assets/images/products/parfum/{{ $top5->gambar1 }}"
                                                                    class="img-fluid  " alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-back">
                                                            <a href="/detail/{{ $top5->id }}">
                                                                <img src="/assets/images/products/parfum/{{ $top5->gambar1 }}"
                                                                    class="img-fluid  " alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-icon icon-inline">
                                                            @if (Auth::check())
                                                                <a id="button_cart" data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart"
                                                                    data-id="{{ $top5->id }}"
                                                                    class="tooltip-top open-AddtoCart"
                                                                    data-tippy-content="Add to cart">
                                                                    <i data-feather="shopping-cart"></i>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)" onclick="openAccount()">
                                                                    <i data-feather="shopping-cart"></i>
                                                                </a>
                                                            @endif
                                                            <a href="javascript:void(0)" class="add-to-wish tooltip-top"
                                                                data-tippy-content="Add to Wishlist">
                                                                <i data-feather="heart"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#quick-view" data-id="{{ $top5->id }}"
                                                                class="quick-view tooltip-top"
                                                                data-tippy-content="Quick View">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                            <a href="compare.html" class="tooltip-top"
                                                                data-tippy-content="Compare">
                                                                <i data-feather="refresh-cw"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail detail-inline">
                                                        <div class="detail-title">
                                                            <div class="detail-left">
                                                                <div class="rating-star">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <a href="/detail/{{ $top5->id }}">
                                                                    <h6 class="price-title">
                                                                        {{ $top5->nama }}
                                                                    </h6>
                                                                </a>
                                                            </div>
                                                            <div class="detail-right">
                                                                <?php if($top5->harga > 0) {
                                                                if($top5->onsale > 0) { ?>
                                                                <div class="check-price">
                                                                    Rp. {{ number_format($top5->harga) . '.00' }}
                                                                </div>
                                                                <div class="price">
                                                                    <div class="price">
                                                                        Rp. {{ number_format($top5->onsale) . '.00' }}
                                                                    </div>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="price">
                                                                    <div class="price">
                                                                        Rp. {{ number_format($top5->harga) . '.00' }}
                                                                    </div>
                                                                </div>
                                                                <?php } 
                                                        } else { ?>
                                                                <div class="price">
                                                                    <div class="price">
                                                                        <?php if($top5->min_price == $top5->max_price) { ?>
                                                                        Rp. {{ number_format($top5->min_price) . '.00' }}
                                                                        <?php } else { ?>
                                                                        Rp. {{ number_format($top5->min_price) . '.00' }}
                                                                        -
                                                                        Rp. {{ number_format($top5->max_price) . '.00' }}
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <?php $j++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider tab end -->

    <!--blog start-->
    <section class="blog ">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="title3">
                        <h4>recent blog post</h4>
                    </div>
                </div>
                <div class="col-12 pr-0">
                    <div class="blog-slide-4 no-arrow">
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="blog(left-sidebar).html">
                                        <img src="/assets/images/layout-5/blog/2.jpg" alt="blog" class="img-fluid ">
                                    </a>
                                </div>
                                <div class="blog-details">
                                    <a href="blog(left-sidebar).html">
                                        <h4>we know that buying items</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend a massa
                                        rhoncus gravida.</p>
                                    <span><a href="javascript:void(0)">read more</a></span>
                                </div>
                                <div class="blog-label">
                                    <p>25 july 2018</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="blog(left-sidebar).html">
                                        <img src="/assets/images/layout-5/blog/3.jpg" alt="blog" class="img-fluid ">
                                    </a>
                                </div>
                                <div class="blog-details">
                                    <a href="blog(left-sidebar).html">
                                        <h4>Latest News Post</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend a massa
                                        rhoncus gravida.</p>
                                    <span><a href="javascript:void(0)">read more</a></span>
                                </div>
                                <div class="blog-label">
                                    <p>25 july 2018</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="blog(left-sidebar).html">
                                        <img src="/assets/images/layout-5/blog/1.jpg" alt="blog" class="img-fluid ">
                                    </a>
                                </div>
                                <div class="blog-details">
                                    <a href="blog(left-sidebar).html">
                                        <h4>we bring you the best </h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend a massa
                                        rhoncus gravida.</p>
                                    <span><a href="javascript:void(0)">read more</a></span>
                                </div>
                                <div class="blog-label">
                                    <p>25 july 2018</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="blog(left-sidebar).html">
                                        <img src="/assets/images/layout-5/blog/5.jpg" alt="blog" class="img-fluid ">
                                    </a>
                                </div>
                                <div class="blog-details">
                                    <a href="blog(left-sidebar).html">
                                        <h4>Latest News Post</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend a massa
                                        rhoncus gravida.</p>
                                    <span><a href="javascript:void(0)">read more</a></span>
                                </div>
                                <div class="blog-label">
                                    <p>25 july 2018</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--blog end-->

    <!--instagram start-->
    <section class="instagram section-big-mt-space  section-big-py-space b-g-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="insta-contant insta-contant-inverse">
                        <div class="slide-7 no-arrow">
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/1.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/2.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/3.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/4.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/5.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/6.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/7.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/8.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/9.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/10.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/11.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/12.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/13.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/14.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/2.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                                <div class="instagram-box">
                                    <img src="/assets/images/insta/6.jpg" class="img-fluid  " alt="insta">
                                    <div class="insta-cover">
                                        <i class="fa fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="insta-sub-contant">
                            <div class="insta-title">
                                <h4><span>#</span>INSTAGRAM</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--instagram end-->
@endsection
