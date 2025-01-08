$(document).ready(function () {
    const selectKecamatan = $("#SelectKecamatan");
    const selectKelurahan = $("#SelectKelurahan");
    const selectStreet = $("#SelectStreet");
    const containerSelectKelurahan = $("#ContainerSelectKelurahan");

    selectKecamatan.selectpicker();
    selectKelurahan.selectpicker();
    selectStreet.selectpicker();
    $(function () {
        selectKecamatan.change(function () {
            let idKecamatan = $(this).val();

            $.ajax({
                url: `/kelurahan/${idKecamatan}`,
                type: "GET",
                success: function (response) {
                    let options = "";
                    let kelurahan = JSON.parse(response);

                    kelurahan.forEach((k) => {
                        options += `<option data-tokens=${k["name"]} class="fs-5 kelurahan" value=${k["id"]}>${k["name"]}</option>`;
                    });

                    selectKelurahan.html(options);
                    selectKelurahan.selectpicker("destroy");
                    selectKelurahan.selectpicker();
                },
            });
        });

        selectKelurahan.change(function () {
            let idKelurahan = $(this).val();

            $.ajax({
                url: `/checkout/street/${idKelurahan}`,
                type: "GET",
                success: function (response) {
                    console.log(response);

                    let options = "";

                    response.forEach((s) => {
                        options += `<option data-tokens=${s["street"]} class="fs-5 street" value=${s["street"]}>${s["street"]}</option>`;
                    });

                    selectStreet.html(options);
                    selectStreet.selectpicker("destroy");
                    selectStreet.selectpicker();
                },
            });
        });

        selectStreet.change(function () {
            let street = $(this).val();

            $.ajax({
                url: `/checkout/cost/${street}`,
                type: "GET",
                success: function (response) {
                    console.log(response["cost"]);

                    let cost = $(".cost");
                    let subtotal = $(".subtotal");
                    let totalOrder = $(".total-order");
                    console.log(cost);

                    cost.text(
                        parseInt(response["cost"]).toLocaleString("id-ID")
                    );
                    totalOrder.text(
                        `Rp. ${(
                            parseInt(subtotal.text()) +
                            parseInt(response["cost"])
                        ).toLocaleString("id-ID")}`
                    );
                },
            });
        });
    });
});
