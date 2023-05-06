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
    $('#yearSlider').slider({
    }).on('change', yearRange);
});
function priceRange(e){
    $('.priceRange').html($(this).val() + " - 2000000");
    $('#minPrice').val($(this).val());
    filterSearch();
}

function yearRange(e){
    let maxYear = $('#maxYear').val();
    $('.yearRange').html($(this).val() + " - " + maxYear);
    $('#minYear').val($(this).val());
    filterSearch();
}


function filterSearch() {
  let action = "fetch_data";
  let minPrice = $("#minPrice").val();
  let maxPrice = $("#maxPrice").val();
  let minYear = $("#minYear").val();
  let maxYear = $("#maxYear").val();
  console.log(minYear);
  console.log(maxYear);
  let make = getFilterData("make");
  let search = $("#search-text-car").val();
  $.ajax({
    url: "action.php",
    method: "POST",
    data: {
      action: action,
      minPrice: minPrice,
      maxPrice: maxPrice,
      make: make,
      minYear: minYear,
      maxYear: maxYear,
      search: search,
    },
    success: function (data) {
      $(".searchResult").html(data);
    },
  });
}

function getFilterData(className) {
  let filter = [];
  $("." + className + ":checked").each(function () {
    filter.push($(this).val());
  });
  return filter;
}


        

