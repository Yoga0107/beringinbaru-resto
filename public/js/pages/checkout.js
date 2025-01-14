let radioButtons = document.getElementsByName("paymentMethod");
let nomorRekening = document.getElementById("nomorRekening");
let pesanCOD = document.getElementById("pesanCOD");
let receipt = document.getElementById("receipt");
let inputReceipt = document.getElementById("inputReceipt");
let btnPayment = document.getElementById("btnPayment");
// let select = document.getElementsByClassName("selectpicker");
// select.selectPicker();

function btnPaymentMethod() {
    // cek radio button yg statusnya checked
    for (var i = 0; i < radioButtons.length; i++) {
        // jika radio button checked
        if (radioButtons[i].checked) {
            console.log("radioButton " + i + ": " + radioButtons[i].value);
            console.log(radioButtons[i].id);

            // menambahkan kelas pada parent radio button
            radioButtons[i].parentElement.classList.add("bg-custom-primary");
            radioButtons[i].parentElement.classList.add("text-light");

            if (
                radioButtons[i].id !== "e-transfer" ||
                inputReceipt.files.length == 1
            ) {
                // mengaktifkan button
                btnPayment.classList.add("btn-primary");
                btnPayment.classList.remove("btn-primary-disabled");
            } else {
                // disable button
                btnPayment.classList.remove("btn-primary");
                btnPayment.classList.add("btn-primary-disabled");
            }

            // jika radio button e-transfer, maka tampilkan nomor rekening, dan input receipt
            // jika radio button bukan e-transfer, tampilkan pesan cod
            if (radioButtons[i].id === "e-transfer") {
                nomorRekening.classList.add("d-block");
                nomorRekening.classList.remove("d-none");

                receipt.classList.add("d-block");
                receipt.classList.remove("d-none");

                pesanCOD.classList.add("d-none");
                pesanCOD.classList.remove("d-block");
            } else {
                pesanCOD.classList.add("d-block");
                pesanCOD.classList.remove("d-none");

                nomorRekening.classList.add("d-none");
                nomorRekening.classList.remove("d-block");

                receipt.classList.add("d-none");
                receipt.classList.remove("d-block");
            }
        } else {
            radioButtons[i].parentElement.classList.remove("bg-custom-primary");
            radioButtons[i].parentElement.classList.remove("text-light");
        }
    }
}

// ketika input file ada perubahan
inputReceipt.addEventListener("change", (event) => {
    // jika ada file
    if (inputReceipt.files.length == 1) {
        // mengaktifkan button
        btnPayment.classList.add("btn-primary");
        btnPayment.classList.remove("btn-primary-disabled");
    } else {
        // disable button
        btnPayment.classList.add("btn-primary-disabled");
        btnPayment.classList.remove("btn-primary");
    }
});
