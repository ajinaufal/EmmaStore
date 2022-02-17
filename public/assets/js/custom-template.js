$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function variant_size_cart_detail(id) {
    var color = document.getElementById("variant_size_detail").value = id;
    console.log(color);
}

function variant_color_cart_detail(id) {
    var size = document.getElementById("variant_color_detail").value = id;
    console.log(size);
}

$(document).ready(function ($) {    
    $(document).on('click', '#opencart', function (e) {
        $.get('/readcart', function (data, status) {
            if (status == "success") {
                console.log("view cart berhasil")
            }
            $("#cart_product").html(data);
        })
    })
    $(document).on('click', '#button_cart_detail', function (e) {
        var size_variant_detail = document.getElementById("variant_size_detail").value;
        var color_variant_detail = document.getElementById("variant_color_detail").value;
        var total = document.getElementById("total_detail").value;

        console.log(document.getElementById("variant_size_detail").value);
        console.log(document.getElementById("variant_color_detail").value);

        e.preventDefault();

        $.ajax({
            url: "/api/add_item",
            type: "POST",
            dataType: 'json',
            data: {
                id_user: $(this).data('user_id'),
                id_product: $(this).data('product_id'),
                id_variant_color: color_variant_detail,
                id_variant_size: size_variant_detail,
                total: total,
            },
            success: function (data) {
                console.log(data);
                document.getElementById("count_cart").innerHTML = data.total;
                console.log('Cart berhasil ditambahkan');
            },
            error: function (data) {
                console.log('Cart gagal ditambahkan');
            }
        });

    })
    $(document).on('click', '#button_cart_etalase', function (e) {
        var variant_size = null;
        var variant_color = null;

        e.preventDefault();

        $.ajax({
            url: "/api/add_item",
            type: "POST",
            data: {
                id_user: $(this).data('user_id'),
                id_product: $(this).data('product_id'),
                id_variant_color: variant_color,
                id_variant_size: variant_size,
                total: 1,
            },
            success: function (data) {
                document.getElementById("count_cart").innerHTML = data.total;
                console.log('Cart berhasil ditambahkan');
            },
            error: function (data) {
                console.log('Cart gagal ditambahkan');
            }
        });
    })
    $(document).on('click', '#button_add_cart_home', function (e) {
        var info = $(this).data('info');
        var size = document.getElementsByName('variant_size_home');
        var color = document.getElementsByName('variant_color_home');

        if (info == 1) {
            for (var i = 0, length = size.length; i < length; i++) {
                if (size[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    size_variant = size[i].value;
                }
            }
            for (var i = 0, length = color.length; i < length; i++) {
                if (color[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    color_variant = color[i].value;
                }
            }
        } else if (info == 2) {
            for (var i = 0, length = size.length; i < length; i++) {
                if (size[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    size_variant = size[i].value;
                }
            }
            var color_variant = null;
        } else if (info == 3) {
            var size_variant = null;
            for (var i = 0, length = color.length; i < length; i++) {
                if (color[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    color_variant = color[i].value;
                }
            }
        } else {
            console.log("Variant Kosong")
        }

        // console.log(color_variant, size_variant, info);

        e.preventDefault();

        $.ajax({
            url: "/api/add_item",
            type: "POST",
            data: {
                id_user: $(this).data('user_id'),
                id_product: $(this).data('product_id'),
                id_variant_color: color_variant,
                id_variant_size: size_variant,
                total: 1,
            },
            success: function (data) {
                document.getElementById("count_cart").innerHTML = data.total;
                console.log('Cart berhasil ditambahkan');
            },
            error: function (data) {
                console.log('Cart gagal ditambahkan');
            }
        });
    })
    $(document).on('click', '#button_cart', function (e) {
        var id = $(this).data('id');

        e.preventDefault();

        $.ajax({
            url: "/cart_home",
            type: "POST",
            data: {
                id_product: id,
            },
            success: function (data) {
                $("#modal_cart_etalase").html(data);
                console.log('Cart berhasil dibuka');
            },
            error: function (data) {
                console.log('Cart gagal dibuka');
            }
        });

    })
    $(document).on('click', '#mincart', function (e) {
        var id = $(this).data('id');
        var user_id = $(this).data('user');
        $.ajax({
            url: "/api/update",
            type: "POST",
            data: {
                code: "-",
                cart_id: id,
                user_id: user_id,
            },
            success: function (data) {
                $("#cart_product").html(data)
                console.log('pengurangan barang berhasil')
            },
            error: function (data) {
                console.log('pengurangan barang gagal')
            }
        });

    })
    $(document).on('click', '#pluscart', function (e) {
        var id = $(this).data('id');
        var user_id = $(this).data('user');
        $.ajax({
            url: "/api/update",
            type: "POST",
            data: {
                code: "+",
                cart_id: id,
                user_id: user_id,
            },
            success: function (data) {
                $("#cart_product").html(data)
                console.log('penambahan barang berhasil')
            },
            error: function (data) {
                console.log('penambahan barang gagal')
            }
        });
    })
    $(document).on('click', '#hapus_item_cart', function (e) {
        var id = $(this).data('id');
        var user_id = $(this).data('user');
        $.ajax({
            url: "/api/dalete",
            type: "POST",
            data: {
                id_item: id,
                user_id: user_id,
            },
            success: function (data) {
                $("#cart_product").html(data)
                console.log('menghapus barang berhasil')
            },
            error: function (data) {
                console.log('menghapus barang gagal')
            }
        });

        $.ajax({
            url: "/api/readtotalcart",
            type: "POST",
            data: {
                user_id: user_id,
            },
            success: function (data) {
                document.getElementById("count_cart").innerHTML = data.total;
                console.log('update total cart sukses')
            },
            error: function (data) {
                console.log('update total cart gagal')
            }
        });
    })
    $(document).on('click', '#button_view_cart', function (e) {
        $.get('/readcart', function (data, status) {
            $("#cart_product").html(data);
        })
    })
    $(document).on('click', '#edit_item_cart', function (e) {
        var id = $(this).data('id');
        // console.log($(this).data('user_id'));
        console.log("masuk");
        e.preventDefault();

        $.ajax({
            url: "/item",
            type: "POST",
            data: {
                id_product: id,
            },
            success: function (data) {
                $("#modal_edit_product").html(data)
                // console.log(data);
                console.log('Edit variant berhasil dibuka');
            },
            error: function (data) {
                console.log('Edit variant gagal dibuka');
            }
        });
    })
    $(document).on('click', '#btn_edit_product', function (e) {

        var info = $(this).data('info');


        if (info == 1) {
            var size = document.getElementsByName('size');
            for (var i = 0, length = size.length; i < length; i++) {
                if (size[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    size_variant = size[i].value;
                }
            }
            var color = document.getElementsByName('color');
            for (var i = 0, length = color.length; i < length; i++) {
                if (color[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    color_variant = color[i].value;
                }
            }
        } else if (info == 2) {
            var size = document.getElementsByName('size');
            for (var i = 0, length = size.length; i < length; i++) {
                if (size[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    size_variant = size[i].value;
                }
            }
            var color_variant = null;
        } else if (info == 3) {
            var size_variant = null;
            var color = document.getElementsByName('color');
            for (var i = 0, length = color.length; i < length; i++) {
                if (color[i].checked) {
                    // do whatever you want with the checked radio
                    // console.log(color[i].value)
                    color_variant = color[i].value;
                }
            }
        }
        var id = document.getElementById('id_edit_product').value;

        e.preventDefault();

        $.ajax({
            url: "/update_variant",
            type: "POST",
            dataType: 'json',
            data: {
                id: id,
                size: size_variant,
                color: color_variant,
            },
            success: function (data) {
                console.log('update item berhasil');
            },
            error: function (data) {
                console.log('update item gagal');
            }
        });

    })
})