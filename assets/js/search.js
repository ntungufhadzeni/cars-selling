$(document).ready(function(){
    filterSearch();
    $('.productDetail').click(function(){
        filterSearch();
    });
    $('#priceSlider').slider({
    }).on('change', priceRange);
});
function priceRange(e){
    $('.priceRange').html($(this).val() + " - 500000");
    $('#minPrice').val($(this).val());
    filterSearch();
}


function filterSearch() {
    $('.searchResult').html('<div id="loading">Loading .....</div>');
    let action = 'fetch_data';
    let minPrice = $('#minPrice').val();
    let maxPrice = $('#maxPrice').val();
    let make = getFilterData('make');
    //let model = getFilterData('model');
    let year = getFilterData('year');
    $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, minPrice: minPrice, maxPrice: maxPrice,
            make:make, year:year},
        success:function(data){
            $('.searchResult').html(data);
        },
        error: function(data) {
            console.log(data.toString());
        }
    });
}

function getFilterData(className) {
    let filter = [];
    $('.'+className+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}
