jQuery(function ($) {
    $(document).ready(function(){
        function loadSelectedFilters() {
            $(".list-filter-box .e-filter-item[aria-pressed='true']").each(function () {
                let filterText = $(this).text().trim();
                let filterId = $(this).attr("data-filter");
                addFilterItem(filterText, filterId);
                $(this).addClass("checked-filter");
            });
        }
        function addFilterItem(text, id) {
            if ($(`.list-filter .filter-item[data-filter='${id}']`).length === 0) {
                let filterHtml = `<div class='filter-item' data-filter='${id}'>${text} <span class='remove-filter'>&times;</span></div>`;
                $(".list-filter").append(filterHtml);
            }
            $('#search-keyword').val('');
        }
        function removeFilterItem(id) {
            $(`.list-filter .filter-item[data-filter='${id}']`).remove();
            $(`.list-filter-box .e-filter-item[data-filter='${id}']`).addClass("action-remove");
            $(`.list-filter-box .e-filter-item[data-filter='${id}']`).click();
            $(`.list-filter-box .e-filter-item[data-filter='${id}']`).removeClass("action-remove");
            $('#search-keyword').val('');
        }
        function loadInputSearch(){
            const keyword = new URLSearchParams(window.location.search).get('keyword');
            if (keyword && keyword.trim() !== '') {
                $('#search-keyword').val(keyword.trim());
            }
        }
        $(".list-filter-box").on("click", ".e-filter-item", function () {
            if($(this).hasClass("action-remove")){
                $(this).removeClass("checked-filter");
            }else{
                let filterText = $(this).text().trim();
                let filterId = $(this).attr("data-filter");
                if ($(this).hasClass("checked-filter")) {
                    $(`.list-filter .filter-item[data-filter='${filterId}']`).remove();
                    $('#search-keyword').val('');
                } else {
                    addFilterItem(filterText, filterId);
                    $(this).attr("aria-pressed", "true");
                }
                $(this).toggleClass("checked-filter");
            }
        });
        $(".list-filter").on("click", ".remove-filter", function () {
            let filterId = $(this).parent().attr("data-filter");
            removeFilterItem(filterId);
        });
        if ($('#filter-area-content').length > 0) {
            loadSelectedFilters();
            loadInputSearch();
        }
        $('#submit-filter').on('click', function(e) {
            e.preventDefault();
            let redirectUrl = `${window.location.origin}/jobs/`;
            const location = $('#location').val();
            const keyword = $('#search-keyword').val().trim();
            if(location !== undefined && location !== ''){
                redirectUrl += `?e-filter-a00064f-location=${encodeURIComponent(location)}`;
            }
            if (keyword !== '') {
                if(redirectUrl == `${window.location.origin}/jobs/`){
                    redirectUrl += `?keyword=${encodeURIComponent(keyword)}`;
                }else{
                    redirectUrl += `&keyword=${encodeURIComponent(keyword)}`;
                }
            }
            window.location.href = redirectUrl;
        });

        $('#submit-filter-jobs').on('click', function(e) {
            e.preventDefault();
            const currentUrl = new URL(window.location.href);
            const redirectUrl = `${window.location.origin}/jobs/`;
            const params = new URLSearchParams(currentUrl.search);
            const keyword = $('#search-keyword').val().trim();
            if (keyword !== '') {
                params.set('keyword', keyword);
            } else {
                params.delete('keyword');
            }
            window.location.href = `${redirectUrl}?${params.toString()}`;
        });
        
        $('.title-filter-mobile').click(function() {
            $(this).toggleClass('active');
            $('.box-filter-taxonomy').toggleClass('show');
        });
    });
});