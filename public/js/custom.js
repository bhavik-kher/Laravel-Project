/* all common methods or functions*/
    $(document).ready(function(){
        $(document).on('click','.articles',function(){
            var article_id = $(this).attr('id');
            var redirect_url = "articles/"+article_id+"/show";
            // console.log(' redirect_url : ',redirect_url);
            window.location.href = redirect_url;
        });
    });
