$('#ONS').parent().hide();
$('#REG').parent().hide();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

if (document.getElementById("tujuan_pengiriman").value == 0) {
    document.getElementById("form_NamaDepanPenerima").style.display = "none";
    document.getElementById("form_NamaBelakangPenerima").style.display = "none";
    document.getElementById("form_TelephonePenerima").style.display = "none";
    // document.getElementById("form_EmailPenerima").style.display = "none";
    document.getElementById("form_AlamatPenerima").style.display = "none";
    document.getElementById("form_KodePosPenerima").style.display = "none";
    document.getElementById("form_search_penerima").style.display = "none";

}

function penerima() {
    if (document.getElementById("tujuan_pengiriman").value == 0) {
        document.getElementById("form_NamaDepanPenerima").style.display = "none";
        document.getElementById("form_NamaBelakangPenerima").style.display = "none";
        document.getElementById("form_TelephonePenerima").style.display = "none";
        // document.getElementById("form_EmailPenerima").style.display = "none";
        document.getElementById("form_AlamatPenerima").style.display = "none";
        document.getElementById("form_KodePosPenerima").style.display = "none";
        document.getElementById("form_search_penerima").style.display = "none";
        $.ajax({
            url: "/data_kota",
            type: "POST",
            data: {
                nama_kota: document.getElementById("search_pemesan").value,
            },
            success: function (data) {
                $('input[type=radio][name=shipping]').change(function () {
                    if (this.value == 'ONS') {
                        document.getElementById("Estimasi").innerHTML = data[0]['ons_est'] + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate']);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate'] + data[2]);
                    } else if (this.value == 'REG') {
                        document.getElementById("Estimasi").innerHTML = data[0]['reg_est'] + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate']);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate'] + data[2]);
                    }
                });
                if (data[0]['ons_est'] != 0 && data[0]['reg_est'] != 0) {
                    $('#REG').parent().show();
                    $('#ONS').parent().show();
                } else if (data[0]['reg_est'] != 0) {
                    $('#REG').parent().show();
                    $('#ONS').parent().hide();
                } else if (data[0]['ons_est'] != 0) {
                    $('#ONS').parent().show();
                    $('#REG').parent().hide();
                }
            },
            error: function (data) {
                console.log('error get data kota');
            }
        });

        document.getElementById("total_bayar").innerHTML = 0;
        document.getElementById("Estimasi").innerHTML = 0 + ' Hari';
        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(document.getElementById("total_harga_barang").value);
        var test = document.getElementsByName('shippingg');
        for (var i = 0, length = test.length; i < length; i++) {
            if (test[i].checked) {
                test[i].checked = false;
            }
        }
        document.getElementById("NamaDepanPenerimaId").value = '';
        document.getElementById("NamaBelakangPenerimaId").value = '';
        document.getElementById("TelephonePenerimaId").value = '';
        document.getElementById("EmailPenerimaId").value = '';
        document.getElementById("AlamatPenerimaId").value = '';
        document.getElementById("KodePosPenerimaId").value = '';
        document.getElementById('search_penerima').value = '';
    } else if (document.getElementById("tujuan_pengiriman").value == 1) {
        document.getElementById("form_NamaDepanPenerima").style.display = "block";
        document.getElementById("form_NamaBelakangPenerima").style.display = "block";
        document.getElementById("form_TelephonePenerima").style.display = "block";
        // document.getElementById("form_EmailPenerima").style.display = "block";
        document.getElementById("form_AlamatPenerima").style.display = "block";
        document.getElementById("form_KodePosPenerima").style.display = "block";
        document.getElementById("form_search_penerima").style.display = "block";
        $('#REG').parent().hide();
        $('#ONS').parent().hide();
        $('#ONSS').parent().hide();
        $('#REGG').parent().hide();
        var test = document.getElementsByName('shippingg');
        for (var i = 0, length = test.length; i < length; i++) {
            if (test[i].checked) {
                test[i].checked = false;
            }
        }
        document.getElementById("total_bayar").innerHTML = 0;
        document.getElementById("Estimasi").innerHTML = 0 + ' Hari';
        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(document.getElementById("total_harga_barang").value);
    }
}


$(document).ready(function ($) {
    $('#search_pemesan').typeahead({
        source: function (query, process) {
            $('#REG').parent().hide();
            $('#ONS').parent().hide();
            $('#ONSS').parent().hide();
            $('#REGG').parent().hide();
            return $.get('/api/search', {
                query: query
            }, function (data) {
                $('#ONSS').parent().hide();
                $('#REGG').parent().hide();
                return process(data);
            });
        },
        updater: function (item) {
            $.ajax({
                url: "/data_kota",
                type: "POST",
                data: {
                    nama_kota: item,
                },
                success: function (data) {
                    $('input[type=radio][name=shipping]').change(function () {
                        if (this.value == 'ONS') {
                            document.getElementById("Estimasi").innerHTML = data[0]['ons_est'] + " Hari";
                            document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate']);
                            document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate'] + data[2]);
                        } else if (this.value == 'REG') {
                            document.getElementById("Estimasi").innerHTML = data[0]['reg_est'] + " Hari";
                            document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate']);
                            document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate'] + data[2]);
                        }
                    });
                    if (data[0]['ons_est'] != 0 && data[0]['reg_est'] != 0) {
                        $('#REG').parent().show();
                        $('#ONS').parent().show();
                    } else if (data[0]['reg_est'] != 0) {
                        $('#REG').parent().show();
                        $('#ONS').parent().hide();
                    } else if (data[0]['ons_est'] != 0) {
                        $('#ONS').parent().show();
                        $('#REG').parent().hide();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
            return item;
        }
    });
    $('#search_penerima').typeahead({
        source: function (query, process) {
            return $.get('/api/search', {
                query: query
            }, function (data) {
                $('#ONSS').parent().hide();
                $('#REGG').parent().hide();
                return process(data);
            });
        },
        updater: function (item) {
            $.ajax({
                url: "/data_kota",
                type: "POST",
                data: {
                    nama_kota: item,
                },
                success: function (data) {
                    $('input[type=radio][name=shipping]').change(function () {
                        if (this.value == 'ONS') {
                            document.getElementById("Estimasi").innerHTML = data[0]['ons_est'] + " Hari";
                            document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate']);
                            document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['ons_rate'] + data[2]);
                        } else if (this.value == 'REG') {
                            document.getElementById("Estimasi").innerHTML = data[0]['reg_est'] + " Hari";
                            document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate']);
                            document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0]['reg_rate'] + data[2]);
                        }
                    });
                    if (data[0]['ons_est'] != 0 && data[0]['reg_est'] != 0) {
                        $('#REG').parent().show();
                        $('#ONS').parent().show();
                    } else if (data[0]['reg_est'] != 0) {
                        $('#REG').parent().show();
                        $('#ONS').parent().hide();
                    } else if (data[0]['ons_est'] != 0) {
                        $('#ONS').parent().show();
                        $('#REG').parent().hide();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
            return item;
        }
    });
    if (document.getElementById("tujuan_pengiriman").value == 0) {
        var nama_kota = document.getElementById("search_pemesan").value;
        if (nama_kota) {
            $.get('/get_data', {
                kota: nama_kota
            }, function (data) {
                $('input[type=radio][name=shippingg]').change(function () {
                    if (this.value == 'ONS') {
                        document.getElementById("Estimasi").innerHTML = data[0].ons_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].ons_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].ons_rate + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].ons_est;
                        document.getElementById("biaya_kirimVal").value = data[0].ons_rate;
                        document.getElementById("total_bayarVal").value = data[0].ons_rate + data[1];

                    } else if (this.value == 'REG') {
                        document.getElementById("Estimasi").innerHTML = data[0].reg_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].reg_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].reg_rate + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].reg_est;
                        document.getElementById("biaya_kirimVal").value = data[0].reg_rate;
                        document.getElementById("total_bayarVal").value = data[0].reg_rate + data[1];
                    }
                });
            });
        }
    } else if (document.getElementById("tujuan_pengiriman").value == 1) {
        var nama_kota = document.getElementById("search_penerima").value;
        if (nama_kota) {
            $.get('/get_data', {
                kota: nama_kota
            }, function (data) {
                $('input[type=radio][name=shippingg]').change(function () {
                    if (this.value == 'ONS') {
                        document.getElementById("Estimasi").innerHTML = data[0].ons_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].ons_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].ons_rate + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].ons_est;
                        document.getElementById("biaya_kirimVal").value = data[0].ons_rate;
                        document.getElementById("total_bayarVal").value = data[0].ons_rate + data[1];

                    } else if (this.value == 'REG') {
                        document.getElementById("Estimasi").innerHTML = data[0].reg_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].reg_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].reg_rate + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].reg_est;
                        document.getElementById("biaya_kirimVal").value = data[0].reg_rate;
                        document.getElementById("total_bayarVal").value = data[0].reg_rate + data[1];
                    }
                });
            });
        }
    }


})