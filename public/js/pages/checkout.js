let radioButtons = document.getElementsByName("paymentMethod");
let nomorRekening = document.getElementById("nomorRekening");
let pesanCOD = document.getElementById("pesanCOD");
let btnPayment = document.getElementById("btnPayment");

function paymentMethod() {
    // cek radio button yg statusnya checked
    for (var i = 0; i < radioButtons.length; i++) {
        // jika radio button checked
        if (radioButtons[i].checked) {
            console.log("radioButton " + i + ": " + radioButtons[i].value);
            console.log(radioButtons[i].id);

            // menambahkan kelas pada parent radio button
            radioButtons[i].parentElement.classList.add("bg-custom-primary");
            radioButtons[i].parentElement.classList.add("text-light");

            // mengaktifkan button
            btnPayment.classList.add("btn-primary");
            btnPayment.classList.remove("btn-primary-disabled");

            // jika radio button e-transfer, maka tampilkan nomor rekening,
            // jika radio button bukan e-transfer, tampilkan pesan cod
            if (radioButtons[i].id === "e-transfer") {
                nomorRekening.classList.add("d-block");
                nomorRekening.classList.remove("d-none");
                pesanCOD.classList.add("d-none");
                pesanCOD.classList.remove("d-block");
            } else {
                pesanCOD.classList.add("d-block");
                pesanCOD.classList.remove("d-none");
                nomorRekening.classList.add("d-none");
                nomorRekening.classList.remove("d-block");
            }
        } else {
            radioButtons[i].parentElement.classList.remove("bg-custom-primary");
            radioButtons[i].parentElement.classList.remove("text-light");
        }
    }
}
