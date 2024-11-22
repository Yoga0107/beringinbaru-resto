$(document).ready(function () {
    const selectKecamatan = $("#SelectKecamatan");
    const selectKelurahan = $("#SelectKelurahan");
    const containerSelectKelurahan = $("#ContainerSelectKelurahan");

    selectKecamatan.selectpicker();
    selectKelurahan.selectpicker();
    $(function () {
        selectKecamatan.change(function () {
            let idKecamatan = $(this).val();

            $.ajax({
                url: `/kelurahan/${idKecamatan}`,
                type: "GET",
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
                        options += `<option data-tokens=${k["name"]} class="fs-5 kelurahan" value=${k["id"]}>${k["name"]}</option>`;
                    });

                    selectKelurahan.html(options);
                    selectKelurahan.selectpicker("destroy");
                    selectKelurahan.selectpicker();
                },
            });
        });
    });
});
