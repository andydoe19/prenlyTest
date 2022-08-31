
/**
 * Upon change of News source, function below is executed
 */
$('#selNewsSource').on('change', function() {
    let source = this.value;  //gets the selected news source from the news source dropdown menu
    let _token = $('input[name="_token"]').val();
    let pageNumber = 1;
    $("#spinnerSmall").show();
    $.ajax({
        type: "POST",
        url: "/sourceId",
        data: { source: source, pageNumber: pageNumber, _token : _token }, //posts the selected option to our ApiController file
        success:function(result) {
            $("#spinnerSmall").hide();
            $('#pageNumber').val(pageNumber);

            $('.mini-posts-content').html($(result).filter('#news').html());
            $('.news-highlights').html($(result).filter('#highlights').html());

            var intval = 1000;
            $(' .mini-posts-content .mini-post.hidden').each(function(i, item) {
                //add click event
                $(item).on('click', onClickArticle);

                intval = intval + 1000;
                setInterval(() => {
                    $(item).fadeIn('slow');
                    $(item).removeClass('hidden');
                }, intval);
            });

            intval = 1000;
            $(' .news-highlights li.hidden').each(function(i, item) {
                //add click event
                $(item).on('click', onClickArticle);
                
                intval = intval + 1000;
                setInterval(() => {
                    $(item).fadeIn('slow');
                    $(item).removeClass('hidden');
                }, intval);
            });
            
        },

        error:function(){
            $("#spinnerSmall").hide();
            alert("An error occurred, please try again!")
        }
    });

})


/**
 * Function for load more News articles button
 */
$('.load-more').on('click', function() {
    let source = $('#selNewsSource').val();  //gets the selected news source from the news source dropdown menu
    let _token = $('input[name="_token"]').val();
    let pageNumber = parseInt($('#pageNumber').val()) + 1;
    $(this).attr('disabled', 'true');
    $(this).text('...Loading');
    $.ajax({
        type: "POST",
        url: "/loadMore",
        data: { source: source, pageNumber: pageNumber, _token : _token }, //posts the selected option to our ApiController file
        success:function(result) {
            $('#pageNumber').val(pageNumber);
            $('.mini-posts-content').append(result);

            $('.load-more').removeAttr('disabled');
            $('.load-more').text('Load more');

            var intval = 1000;
            $(' .mini-posts-content .mini-post.hidden').each(function(i, item) {
                //add click event
                $(item).on('click', onClickArticle);

                //show article
                intval = intval + 1000;
                setInterval(() => {
                    $(item).fadeIn('slow');
                    $(item).removeClass('hidden');
                }, intval);
            });
            
        },

        error:function(){
            $('.load-more').removeAttr('disabled');
            $('.load-more').text('Load more');
            alert("An error occurred, please try again!")
        }
    });

})


/**
 * Funtion called upon click of any article
 */
$('.articleTitle, .articleImage').on('click', onClickArticle);

function onClickArticle(e) {
    elem = e.target;

    var article = $(elem).closest('article');

    var imageUrl = $(article).find('.image img').attr('src');
    var title = $(article).find('.articleTitle a').text();
    var publishedAt = $(article).find('.articlePublishedAt').val();
    var author = $(article).find('.articleAuthor').val();
    var desc = $(article).find('.articleDesc').val();
    var url = $(article).find('.articleUrl').val();
    var content = $(article).find('.articleContent').val();
    var sourceId = $(article).find('.articleSourceId').val();
    var sourceName = $(article).find('.articleSourceName').val();

    var params = {
        "image" : imageUrl,
        "title" : title,
        "publishedAt" : publishedAt,
        "author" : author,
        "desc" : desc,
        "url" : url,
        "content" : content,
        "sourceId" : sourceId,
        "sourceName" : sourceName
    };

    //show spinner
    showFullScreenSpinner();

    
    /**
     * Make a get request to an embedded nodejs server, to get full contents of the selected article
     * (this app should be running locally, if it isn't, run in terminal with the command: "node artparser.js" )
     */
     console.log('..... retrieving article content');
    $.ajax({
        type: "GET",
        url: "http://localhost:3008/?url=" + url,
        timeout : 60000, //(60 secs timeout)
        success:function(result) {
            console.log('<<<<..... article content retrieved');
            params.content = result.content;
            submitArticleDetailForm(params);
        },

        error:function(){
            hideFullScreenSpinner();
            alert('Error retrieving Content. Please try again!')
            console.log("Error occurred retrieving article CONTENTS, please try again later!")
        }
    });
    
}

function submitArticleDetailForm(params) {
    var form = document.getElementById("article-form");
    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
         }
    }
    form.submit();
}


//remove first and last double quotes from article content
$('document').ready(function() {
    if ( $('.decoded-article-content').length ) {

        let text = $('.decoded-article-content').html();
        let contentStr = $("<textarea/>").html(text).text();
        $('.decoded-article-content').html('');
        $('.decoded-article-content').append($(contentStr));

        console.log('**************** removed 1st n last quotes');
    }
})


// (A) SHOW & HIDE SPINNER
function showFullScreenSpinner () {
  document.getElementById("spinner").classList.add("show");
}
function hideFullScreenSpinner () {
  document.getElementById("spinner").classList.remove("show");
}



