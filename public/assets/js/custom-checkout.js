$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function ClearValuePenerima() {
    document.getElementById("NamaDepanPenerimaId").value = '';
    document.getElementById("NamaBelakangPenerimaId").value = '';
    document.getElementById("TelephonePenerimaId").value = '';
    document.getElementById("AlamatPenerimaId").value = '';
    document.getElementById("KodePosPenerimaId").value = '';
    document.getElementById('search_penerima').value = '';
}

function ClearRincian() {
    
}

function GetNamaKotaPemesan(nama_kota, tujuan_pengirim) {
    if (nama_kota) {
        $.get('/get_data', {
            kota: nama_kota
        }, function (data) {
            if (document.getElementById("tujuan_pengiriman").value == tujuan_pengirim) {
                if (data[0]['reg_est'] != 0) {
                    $('#REG').parent().show();
                }
                if (data[0]['ons_est'] != 0) {
                    $('#ONS').parent().show();
                }

                $('input[type=radio][name=shipping]').change(function () {
                    if (this.value == 'ONS') {
                        document.getElementById("Estimasi").innerHTML = data[0].ons_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].ons_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format((Math.ceil(parseFloat(document.getElementById("total_berat_barang").value)) * data[0].ons_rate) + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].ons_est;
                        document.getElementById("biaya_kirimVal").value = data[0].ons_rate;
                        document.getElementById("total_bayarVal").value = (Math.ceil(parseFloat(document.getElementById("total_berat_barang").value)) * data[0].ons_rate) + data[1];

                    } else if (this.value == 'REG') {
                        document.getElementById("Estimasi").innerHTML = data[0].reg_est + " Hari";
                        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(data[0].reg_rate);
                        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format((Math.ceil(parseFloat(document.getElementById("total_berat_barang").value)) * data[0].reg_rate) + data[1]);

                        document.getElementById("EstimasiVal").value = data[0].reg_est;
                        document.getElementById("biaya_kirimVal").value = data[0].reg_rate;
                        document.getElementById("total_bayarVal").value = (Math.ceil(parseFloat(document.getElementById("total_berat_barang").value)) * data[0].reg_rate) + data[1];
                    }
                });
            }
            
        });
    }
}

function ViewDataPenerima() {
    if (document.getElementById("tujuan_pengiriman").value == 0) {

        $('#REG').parent().hide();
        $('#ONS').parent().hide();

        document.getElementById("form_NamaDepanPenerima").style.display = "none";
        document.getElementById("form_NamaBelakangPenerima").style.display = "none";
        document.getElementById("form_TelephonePenerima").style.display = "none";
        document.getElementById("form_AlamatPenerima").style.display = "none";
        document.getElementById("form_KodePosPenerima").style.display = "none";
        document.getElementById("form_search_penerima").style.display = "none";

        document.getElementById("Estimasi").innerHTML = 0 + " Hari";
        document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(0);
        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(document.getElementById("total_harga_barang").value);

        ClearValuePenerima();
        
        var nama_kota = document.getElementById("search_pemesan").value;
        GetNamaKotaPemesan(nama_kota,0);

    } else if (document.getElementById("tujuan_pengiriman").value == 1) {

        $('#REG').parent().hide();
        $('#ONS').parent().hide();

        document.getElementById("form_NamaDepanPenerima").style.display = "block";
        document.getElementById("form_NamaBelakangPenerima").style.display = "block";
        document.getElementById("form_TelephonePenerima").style.display = "block";
        document.getElementById("form_AlamatPenerima").style.display = "block";
        document.getElementById("form_KodePosPenerima").style.display = "block";
        document.getElementById("form_search_penerima").style.display = "block";

        document.getElementById("EstimasiVal").value = 0;
        document.getElementById("biaya_kirimVal").value = 0;
        document.getElementById("total_bayarVal").value = 0;

        document.getElementById("biaya_kirim").innerHTML = 0;
        document.getElementById("Estimasi").innerHTML = 0 + ' Hari';
        document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(document.getElementById("total_harga_barang").value);
    }
}

function SearchKotaPemesan() {
    $('#search_pemesan').typeahead({
        source: function (query, process) {
            if (document.getElementById("tujuan_pengiriman").value == 0) {
                $('#REG').parent().hide();
                $('#ONS').parent().hide();

                document.getElementById("Estimasi").innerHTML = 0 + " Hari";
                document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(0);
                document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(0);

                document.getElementById("EstimasiVal").value = 0;
                document.getElementById("biaya_kirimVal").value = 0;
                document.getElementById("total_bayarVal").value = 0;
            }
            return $.get('/api/search', {
                query: query
            }, function (data) {
                return process(data);
            });
        },
        updater: function (item) {
            GetNamaKotaPemesan(item,0);
            return item;
        }
    });
}

function SearchKotaPenerima() {
    $('#search_penerima').typeahead({
        source: function (query, process) {
            if (document.getElementById("tujuan_pengiriman").value == 1) {
                $('#REG').parent().hide();
                $('#ONS').parent().hide();

                document.getElementById("Estimasi").innerHTML = 0 + " Hari";
                document.getElementById("biaya_kirim").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(0);
                document.getElementById("total_bayar").innerHTML = "Rp. " + new Intl.NumberFormat(['ban', 'id']).format(0);

                document.getElementById("EstimasiVal").value = 0;
                document.getElementById("biaya_kirimVal").value = 0;
                document.getElementById("total_bayarVal").value = 0;
            }
            return $.get('/api/search', {
                query: query
            }, function (data) {
                return process(data);
            });
        },
        updater: function (item) {
            GetNamaKotaPemesan(item,1);
            return item;
        }
    });
}


$(document).ready(function ($) {
    document.getElementById("tujuan_pengiriman").addEventListener("change", ViewDataPenerima);
    ViewDataPenerima();
    SearchKotaPemesan();
    SearchKotaPenerima();
})