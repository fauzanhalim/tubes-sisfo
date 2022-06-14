function updateHarga() {
    var cbKodeBarang = document.getElementById("barang");

    if (cbKodeBarang.selectedIndex > 0) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                response = xhr.responseText;
                var data = JSON.parse(response);
                var tfHargaBarang = document.getElementById("harga_barang");

                // if (tfHargaBarang && tfHargaBarang.value) {
                //     tfHargaBarang.value = "";
                // }

                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        tfHargaBarang.value = data[i].harga_jual;
                    }
                }
            }
        };
        var kode_barang =
            cbKodeBarang.options[cbKodeBarang.selectedIndex].value;
        xhr.open(
            "GET",
            "get_harga_barang.php?kode_barang=" + kode_barang,
            true
        );
        xhr.send();
    }
}

function updateTotalHarga() {
    var tfHargaBarang = document.getElementById("harga_barang");
    var tfQty = document.getElementById("qty");
    var tfTotalHarga = document.getElementById("total_harga");

    var res = parseFloat(tfHargaBarang.value) * parseFloat(tfQty.value);
    tfTotalHarga.setAttribute("value", res);
}

// function updateTotalHarga() {
//     var tfQty = document.getElementById("qty");
//     var tfTotalHarga = document.getElementById("total_harga");
//     var tfHargaBarang = document.getElementById("harga_barang");

//     tfQty.addEventListener("keyup", function () {
//         var xhr = XMLHttpRequest();

//         xhr.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 var counterQty = parseFloat(tfQty.innerHTML);
//                 var counterHarga = parseFloat(tfHargaBarang.innerHTML);
//                 tfTotalHarga.innerHTML = counterHarga * counterQty;
//             }
//         };
//     });
// }
