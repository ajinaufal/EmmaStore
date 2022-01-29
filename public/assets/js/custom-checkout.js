$('#ONS').parent().hide();
$('#REG').parent().hide();

$(document).ready(function ($) {
    var nama_kota = document.getElementById("search").value;
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
})