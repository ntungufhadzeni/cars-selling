$(document).ready(function(){
    filterSearch();
    $('.productDetail').click(function(){
        filterSearch();
    });
    $('#priceSlider').slider({
    }).on('change', priceRange);
    $('#search-text-car').keyup(function () {
        let search = $(this).val();
        console.log(search)
        if (search !== '') {
            filterSearch();
        }
    });
});
function priceRange(e){
    $('.priceRange').html($(this).val() + " - 2000000");
    $('#minPrice').val($(this).val());
    filterSearch();
}


function filterSearch() {
    $('.searchResult').html('<div id="loading">Loading .....</div>');
    let action = 'fetch_data';
    let minPrice = $('#minPrice').val();
    let maxPrice = $('#maxPrice').val();
    let make = getFilterData('make');
    let year = getFilterData('year');
    let search = $('#search-text-car').val();
    $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, minPrice: minPrice, maxPrice: maxPrice,
            make:make, year:year, search: search},
        success:function(data){
            console.log(data);
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
