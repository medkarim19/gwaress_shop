$(document).ready(function () {
    if (window.location.href.indexOf('menshop') !== -1) {
        var searchTimerMen;
        var searchXhrMen;

        function debounceMen(func, wait, immediate) {
            var timeout;

            return function () {
                var context = this,
                    args = arguments;

                var later = function () {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };

                var callNow = immediate && !timeout;

                clearTimeout(timeout);
                timeout = setTimeout(later, wait);

                if (callNow) func.apply(context, args);
            };
        }

        var debouncedSearchMen = debounceMen(function (searchQuery) {
            clearTimeout(searchTimerMen);
            if (searchXhrMen) {
                searchXhrMen.abort();
            }

            searchTimerMen = setTimeout(function () {
                searchXhrMen = $.ajax({
                    url: 'index.php?page=menshop&action=searchProductsForMen',
                    type: 'GET',
                    data: { search: searchQuery },
                    success: function (response) {
                        
                        console.log('Response:', response);
                        console.log('Before Replacement:', $('#productContainerMen').html());

                        
                        $('#productContainerMen').replaceWith($(response).find('#productContainerMen'));

                        
                        console.log('After Replacement:', $('#productContainerMen').html());
                    },
                    error: function (xhr, status, error) {
                        console.error('Error occurred during AJAX request:', status, error);
                    }
                });
            }, 300);
        }, 300);

        $('#searchInputHeader').on('input', function () {
            var searchQueryMen = $(this).val();
            debouncedSearchMen(searchQueryMen);
        });

    
        $(window).on('beforeunload', function () {
            clearTimeout(searchTimerMen);
            if (searchXhrMen) {
                searchXhrMen.abort();
            }
        });
        $(window).on('load', function () {
            var initialSearchQueryMen = $('#searchInputHeader').val();
            debouncedSearchMen(initialSearchQueryMen);
        });
    }
});
