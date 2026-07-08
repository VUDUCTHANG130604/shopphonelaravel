$(document).ready(function() {
    var priceSlider = $(".price-range, .price-slider");

    if (priceSlider.length > 0) {
        var minPrice = parseInt(priceSlider.attr('data-min')) || 0;
        var maxPrice = parseInt(priceSlider.attr('data-max')) || 10000000;

        priceSlider.slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $("#minamount").val(ui.values[0]);
                $("#maxamount").val(ui.values[1]);
            }
        });

        $("#minamount").val(minPrice);
        $("#maxamount").val(maxPrice);
    }

    $(".filter-form, form[action='tim-kiem']").on('submit', function() {
        var fromPrice = parseInt($("#minamount").val()) || 0;
        var toPrice = parseInt($("#maxamount").val()) || 0;

        $("#minamount").val(fromPrice);
        $("#maxamount").val(toPrice);
    });

    $("#minamount, #maxamount").on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
