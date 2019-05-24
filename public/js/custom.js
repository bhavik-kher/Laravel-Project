/* all common methods or functions*/
    $(document).ready(function(){
        // $(document).on('click','.articles',function(){
        //     var article_id = $(this).attr('id');
        //     var redirect_url = "articles/"+article_id+"/show";
        //     // console.log(' redirect_url : ',redirect_url);
        //     window.location.href = redirect_url;
        // });

        $(document).on('click','.articleAction',function(){
				var actionType = $(this).attr('action');
				var articleid = $(this).attr('articleid');
				console.log(actionType);
				var objdata ;
				if(actionType == 'like'){
					 objdata = { 'articleid':articleid,'action':'like'};
				}else if(actionType == 'dislike'){
					 objdata = { 'articleid':articleid,'action':'dislike'};
				}else if(actionType == 'block'){
					 objdata = { 'articleid':articleid,'action':'block'};
				}
				
				var thisElem = $(this); 
				$.ajax({
					url: articleActionUrl,
					type: 'POST',
					dataType: "JSON",
					data: objdata,
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (data, status){
						if(data.success){
							if(actionType == 'like' && !data.isAlreadyLiked){
								$(thisElem).html(`<span>${data.likes}</span>`);
								$('#dislikes_'+articleid).html(`<span>${data.dislikes}</span>`);
								$(thisElem).toggleClass('fa-thumbs-up fa-thumbs-o-up');
								$('#dislikes_'+articleid).removeClass('fa-thumbs-down');
								$('#dislikes_'+articleid).addClass('fa-thumbs-o-up');
							}else if(actionType == 'dislike' && !data.isAlreadyDisliked){
								$(thisElem).html(`<span>${data.dislikes}</span>`);
								$('#likes_'+articleid).html(`<span>${data.likes}</span>`);
								$(thisElem).toggleClass('fa-thumbs-down fa-thumbs-o-up');
								$('#likes_'+articleid).removeClass('fa-thumbs-up ');
								$('#likes_'+articleid).addClass('fa-thumbs-o-up');

							}
						}
					},
					error: function (xhr, desc, err)
					{
						console.log("something went wrong! Please try again later.");
					}
				});
			});
    });
