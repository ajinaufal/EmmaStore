    <ul class="cart_product">
        @foreach ($data as $item)
            @if ($item['jumlah'])
                <li>
                    <div class="media">
                        <a href="product-page(left-sidebar).html">
                            <img alt="megastore1" class="me-3"
                                src="/assets/images/products/parfum/{{ $item['gambar'] }}">
                        </a>
                        <div class="media-body">
                            <a href="product-page(left-sidebar).html">
                                <h4>{{ $item['name_produk'] }}</h4>
                            </a>
                            <h6>
                                Rp. {{ number_format($item['onsale'], 0, ',', '.') }} @if ($item['harga']) <span>Rp. {{ number_format($item['harga'], 0, ',', '.') }}</span> @endif
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button id="mincart" class="qty-minus" data-id="{{ $item['id_cart'] }}"
                                            data-user="{{ $item['user_id'] }}"></button>
                                        <input class="qty-adj form-control" type="text" value="{{ $item['jumlah'] }}"
                                            disabled />
                                        @if ($item['jumlah'] < $item['stock'])
                                            <button id="pluscart" class="qty-plus"
                                                data-id="{{ $item['id_cart'] }}"
                                                data-user="{{ $item['user_id'] }}"></button>
                                        @endif
                                    </div>
                                </div>
                                <div class="pro-add">
                                    @if ($variant->where('product_id', $item['product_id'])->count() != 0)
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit-product" data-user="{{ $item['user_id'] }}"
                                            id="edit_item_cart" data-id="{{ $item['product_id'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif
                                    <a href="javascript:void(0)" id="hapus_item_cart"
                                        data-id="{{ $item['id_cart'] }}" data-user="{{ $item['user_id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif

        @endforeach
    </ul>

    <ul class="cart_total">
        <li>
            subtotal : <span id="hargacart">{{ number_format($harga, 0, ',', '.') }}</span>
        </li>
        <li>
            shpping <span>free</span>
        </li>
        <li>
            taxes <span id="taxcart">{{ number_format($tax, 0, ',', '.') }}</span>
        </li>
        <li>
            <div class="total">
                total<span>{{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </li>
        <li>
            <div class="buttons">
                <a href="/checkout" class="btn btn-solid btn-sm btn-block ">checkout</a>
            </div>
        </li>
    </ul>
