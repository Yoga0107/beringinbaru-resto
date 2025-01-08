$(document).ready(function () {
    const selectDistrict = $("#SelectDistrict");
    const selectVillage = $("#SelectVillage");
    const selectCost = $("#SelectCost");

    const oldDistrict = $("#oldDistrict").text();
    const oldVillage = $("#oldVillage").text();
    const oldCost = $("#oldCost").text();

    // selectDistrict.selectpicker();
    // selectVillage.selectpicker();
    // selectCost.selectpicker();

    selectDistrict.selectpicker("val", oldDistrict);
    selectVillage.selectpicker("val", oldVillage);
    selectCost.selectpicker("val", oldCost);

    // get data kelurahan ketika kecamatan berubah
    selectDistrict.change(function () {
        let idDistrict = $(this).val();
        selectVillage.selectpicker("destroy");

        $.ajax({
            url: `/kelurahan/${idDistrict}`,
            type: "GET",
            beforeSend: function () {},
            success: function (response) {
                // console.log(
                //     containerSelectKelurahan
                //         .find(".dropdown")
                //         .find(".dropdown-menu")
                //         .find("ul")
                //         .remove("li")
                // );

                // // selectKelurahan.selectpicker();
                // // selectKelurahan.selectpicker("refresh");

                // // reset state for selectpicker kelurahan
                // selectKelurahan.selectpicker("deselectAll");
                // selectKelurahan.find("option").remove();
                // // selectKelurahan.find("li").remove();
                // // selectKelurahan.selectpicker("refresh");

                let options = "";
                let kelurahan = JSON.parse(response);

                kelurahan.forEach((k) => {
                    options += `<option data-tokens=${k["name"]} value=${k["id"]}>${k["name"]}</option>`;
                });

                selectVillage.html(options);
                selectVillage.selectpicker();
            },
        });
    });
});
