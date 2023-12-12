$(document).ready(function () {
    if (window.location.href.indexOf('womenshop') !== -1) {
        var searchTimerWomen;
        var searchXhrWomen;

        function debounceWomen(func, wait, immediate) {
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

        var debouncedSearchWomen = debounceWomen(function (searchQuery) {
            clearTimeout(searchTimerWomen);
            if (searchXhrWomen) {
                searchXhrWomen.abort();
            }

            searchTimerWomen = setTimeout(function () {
                searchXhrWomen = $.ajax({
                    url: 'index.php?page=womenshop&action=searchProductsForWomen',
                    type: 'GET',
                    data: { search: searchQuery },
                    success: function (response) {
                        console.log('Response:', response);
                        console.log('Before Replacement:', $('#productContainerWomen').html());
                        $('#productContainerWomen').replaceWith($(response).find('#productContainerWomen'));
                        console.log('After Replacement:', $('#productContainerWomen').html());
                    },
                    error: function () {
                        console.error('Error occurred during AJAX request');
                    }
                });
            }, 300);
        }, 300);

        $('#searchInputHeader').on('input', function () {
            var searchQueryWomen = $(this).val();
            debouncedSearchWomen(searchQueryWomen);
        });

        
        $(window).on('beforeunload', function () {
            clearTimeout(searchTimerMen);
            if (searchXhrWomen) {
                searchXhrWomen.abort();
            }
        });
        $(window).on('load', function () {
            var initialSearchQueryWomen = $('#searchInputHeader').val();
            debouncedSearchWomen(initialSearchQueryWomen);
        });
    }
});
