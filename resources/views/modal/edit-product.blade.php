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

<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="pro-group">
    <div class="product-img">
        <div class="media">
            <div class="img-wraper">
                <a href="product-page(left-sidebar).html">
                    <img src="/assets/images/products/parfum/{{ $product->gambar1 }}" alt="" class="img-fluid">
                </a>
            </div>
            <div class="media-body">
                <a>
                    <h3 id="tittle_image_edit">{{ $product->nama }}</h3>
                </a>
                <h6>Rp. {{ number_format($product->onsale) }}<span>Rp. {{ number_format($product->harga) }}</span>
                </h6>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="id" value="{{ $product->id }}" id="id_edit_product">
@if ($variant->where('jenis', 'Ukuran')->count() != 0)
    <div class="pro-group">
        <h6 class="product-title">Select Size</h6>
        <div class="size-box">
            <ul>
                @foreach ($variant->where('jenis', 'Ukuran') as $item)
                    <label class="check">
                        <input name="size" type="radio" value="{{ $item->id }}" id="variant_size_detail">
                        <span>{{ $item->nama }}</span>
                    </label>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if ($variant->where('jenis', 'Warna')->count() != 0)
    <div class="pro-group">
        <h6 class="product-title">Select color</h6>
        <div class="color-selector inline colors">
            <ul>
                @foreach ($variant->where('jenis', 'Warna') as $value)
                    @if ($value->nama == 'White')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: white"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Brown')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: brown"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Glossy Red')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: red"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Purple')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: purple"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Tosca')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: green"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Pink')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: pink"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Orange')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: orange"></span>
                            </label>
                        </li>
                    @elseif ($value->nama == 'Matte Red')
                        <li>
                            <label>
                                <input type="radio" name="color" value="{{ $value->id }}" id="variant_color_detail"
                                    @if ($value->id == $cart->variant_color) checked @endif>
                                <span class="swatch" style="background-color: rgb(95, 6, 6)"></span>
                            </label>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="pro-group mb-0">
    <div class="modal-btn">
        <button id="btn_edit_product" class="btn btn-solid btn-sm" data-bs-dismiss="modal" aria-label="Close"
            @if ($variant->where('jenis', 'Ukuran')->count() != 0 && $variant->where('jenis', 'Warna')->count() != 0) data-info="1" @endif @if ($variant->where('jenis', 'Ukuran')->count() != 0) data-info="2" @endif @if ($variant->where('jenis', 'Warna')->count() != 0) data-info="3" @endif>
            update
        </button>
        <a href="product-page(left-sidebar).html" class="btn btn-solid btn-sm">
            more detail
        </a>
    </div>
</div>
