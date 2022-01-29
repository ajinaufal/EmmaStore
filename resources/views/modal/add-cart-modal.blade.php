<style>
    label.check {
        cursor: pointer
    }

    label.check input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.check span {
        padding: 7px 14px;
        border: 1px solid #dddddd;
        display: inline-block;
        color: #000000;
        border-radius: 3px;
        text-transform: uppercase
    }

    label.check input:checked+span {
        border-color: #dddddd;
        background-color: #dddddd;
    }

    .colors ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .colors li {
        display: inline-block;
    }

    .colors label {
        cursor: pointer;
    }

    .colors input {
        display: none;
    }

    .colors input[type="radio"]:checked+.swatch {
        box-shadow: inset 0 0 0 2px white;
    }

    .swatch {
        display: inline-block;
        vertical-align: middle;
        height: 30px;
        width: 30px;
        border: 1px solid #d4d4d4;
    }

</style>

<div class="modal-content">
    <div class="modal-body modal1 ">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="modal-bg addtocart">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="media">
                            <a href="javascript:void(0)">
                                <img id="imageaddcart" src="/assets/images/products/parfum/{{ $product->gambar1 }}"
                                    alt="cart-image" class="img-fluids">
                            </a>
                            <div class="media-body align-self-center text-center">
                                <a href="javascript:void(0)" id="modal-body">
                                    <h6>
                                        <i class="fa fa-check"></i>Item
                                        <span id="CartName">{{ $product->nama }}</span>
                                    </h6>
                                </a>
                                @if ($variant->count() != 0)
                                    @if ($variant->where('jenis', 'Ukuran')->count() != 0)
                                        <h6>Varian Ukuran Produk</h6>
                                        <div>
                                            @foreach ($variant as $item)
                                                @if ($item->jenis == 'Ukuran')
                                                    <label class="check">
                                                        <input id="variant_size_home" type="radio"
                                                            name="variant_size_home" value="{{ $item->id }}">
                                                        <span>{{ $item->nama }}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($variant->where('jenis', 'Warna')->count() != 0)
                                        <h6>Varian Warna Produk</h6>
                                        <div class="color-selector inline colors">
                                            <ul>
                                                @foreach ($variant as $value)
                                                    @if ($value->jenis == 'Warna')
                                                        <li>
                                                            <label>
                                                                <input id="variant_color_home" type="radio"
                                                                    name="variant_color_home"
                                                                    value="{{ $value->id }}" class="color">
                                                                @if ($value->nama == 'White')
                                                                    <span class="swatch"
                                                                        style="background-color: white"></span>
                                                                @elseif ($value->nama == 'Brown')
                                                                    <span class="swatch"
                                                                        style="background-color: brown"></span>
                                                                @elseif ($value->nama == 'Glossy Red')
                                                                    <span class="swatch"
                                                                        style="background-color: red"></span>
                                                                @elseif ($value->nama == 'Purple')
                                                                    <span class="swatch"
                                                                        style="background-color: purple"></span>
                                                                @elseif ($value->nama == 'Tosca')
                                                                    <span class="swatch"
                                                                        style="background-color: green"></span>
                                                                @elseif ($value->nama == 'Pink')
                                                                    <span class="swatch"
                                                                        style="background-color: pink"></span>
                                                                @elseif ($value->nama == 'Orange')
                                                                    <span class="swatch"
                                                                        style="background-color: orange"></span>
                                                                @elseif ($value->nama == 'Matte Red')
                                                                    <span class="swatch"
                                                                        style="background-color: rgb(95, 6, 6)"></span>
                                                                @endif
                                                            </label>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endif
                                <div class="buttons">
                                    @if (auth()->check())
                                        <button id="button_add_cart_home" data-user_id="{{ auth()->user()->id }}"
                                            data-product_id="{{ $product->id }}" 
                                            @if ($variant->where('jenis', 'Ukuran')->count() != 0 && $variant->where('jenis', 'Warna')->count() != 0) data-info="1" @endif
                                            @if ($variant->where('jenis', 'Ukuran')->count() != 0) data-info="2" @endif
                                            @if ($variant->where('jenis', 'Warna')->count() != 0) data-info="3" @endif
                                            class="view-cart btn btn-sm btn-solid" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Add cart
                                        </button>
                                        <a id="button_view_cart" href="javascript:void(0)" onclick="openCart()"
                                            class="view-cart btn btn-sm btn-solid" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Your cart
                                        </a>
                                        <a href="/checkout" class="checkout btn btn-sm btn-solid">
                                            Check out
                                        </a>
                                    @endif
                                </div>
                                <div class="upsell_payment">
                                    <img src="/assets/images/paymat.png" class="img-fluid " alt="cart-modal-popup">
                                </div>
                            </div>
                        </div>
                        <div class="product-section">
                            <div class="col-12 product-upsell text-center">
                                <h4>Customers who bought this item also.</h4>
                            </div>
                            <div class="row" id="upsell_product">
                                <div class="product-box col-sm-3 col-6">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="product-page(left-sidebar).html">
                                                <img src="/assets/images/layout-4/product/1.jpg"
                                                    class="img-fluid blur-up lazyload mb-1" alt="cotton top">
                                            </a>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-page(left-sidebar).html">
                                                <h6>sony xperia m5</h6>
                                            </a>
                                            <h4>$130<span>$150</span></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-box col-sm-3 col-6">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="product-page(left-sidebar).html">
                                                <img src="/assets/images/layout-4/product/2.jpg"
                                                    class="img-fluid blur-up lazyload mb-1" alt="cotton top">
                                            </a>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-page(left-sidebar).html">
                                                <h6>wireless speaker</h6>
                                            </a>
                                            <h4>$80<span>$100</span></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-box col-sm-3 col-6">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="product-page(left-sidebar).html">
                                                <img src="/assets/images/layout-4/product/a1.jpg"
                                                    class="img-fluid blur-up lazyload mb-1" alt="cotton top">
                                            </a>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-page(left-sidebar).html">
                                                <h6>samsung galaxy m21</h6>
                                            </a>
                                            <h4>$80<span>$110</span></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-box col-sm-3 col-6">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="product-page(left-sidebar).html">
                                                <img src="/assets/images/layout-4/product/a2.jpg"
                                                    class="img-fluid blur-up lazyload mb-1" alt="cotton top">
                                            </a>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-page(left-sidebar).html">
                                                <h6>Flip 5 Portable Speaker</h6>
                                            </a>
                                            <h4>$150<span>$170</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
