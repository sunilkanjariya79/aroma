// for review the post image
var input= document.querySelector("select_post_img");
input.addEventListener("change",preview);
function preview(){
    var fileobject=this.files[0];
    var FileReader =new FileReader()
    FileReader.readAsDataURL(fileobject);
    Filereader.onload=function()
    {
        var image_src=Filereader.request;
        var image=document.querySelector("#post_img");
        image.setAttribute('src',image_src);
        image.setAttribute('style','display:');
    }
}

//for follw the user
$(".followbtn").click(function(){
    var user_id_v=$(this).data('userId');
    var button=this;
    $(button).attr('disabled',true);
    $.ajax({
        url:'ajax.php?follow',
        method:'post',
        dataType:'json',
        data:{user_id:user_id_v},
        success:function (response){
            if(response.status){
                $(button).data('userId',0);
                $(button).html("followed");
            }
            else{
                $(button).attr('disabled',false);
            }
        }
    })
});


//for like the post
$(".like_btn").click(function(){
    var post_id_v=$(this).data('postId');
    var button=this;
    $(button).attr('disabled',true);
    $.ajax({
        url:'ajax.php?like',
        method:'post',
        dataType:'json',
        data:{post_id:post_id_v},
        success:function (response){
            if(response.status){
                $(button).attr('disabled',false);
                $(button).hide()
                s(button).siblings('.unlike_btn').show();
                location:reload();
            }
            else{
                $(button).attr('disabled',false);
            }
        }
    })
});

//for unlike the post
$(".unlike_btn").click(function(){
    var post_id_v=$(this).data('postId');
    var button=this;
    $(button).attr('disabled',true);
    $.ajax({
        url:'ajax.php?unlike',
        method:'post',
        dataType:'json',
        data:{post_id:post_id_v},
        success:function (response){
            if(response.status){
                $(button).attr('disabled',false);
                $(button).hide()
                s(button).siblings('.like_btn').show();
                location:reload();
            }
            else{
                $(button).attr('disabled',false);
            }
        }
    })
});

//for adding comment 
$(".add-comment").click(function(){
    var comment_v= $(button).siblings('.comment-input').val();
    if(comment==''){
        return 0;
    }
    var post_id_v=$(this).data('postId');
    var cs=$(this).data('cs');
    $(button).attr('disabled',true);
    $(button).siblings('.comment-input').attr('disabled',true);
    $.ajax({
        url:'ajax.php?addcomment',
        method:'post',
        dataType:'json',
        data:{post_id:post_id_v,comment:comment_v},
        success:function (response){
            if(response.status){
                $(button).attr('disabled',false);
                $(button).siblings('.comment-input').attr('disabled',false);
                $(button).siblings('.comment-input').val('');
                $("#"+cs).append(response.comment);
                $('.nce').hide();
                $('.nce').hide();
            }
            else{
                $(button).attr('disabled',false);
                $(button).siblings('.comment-input').attr('disabled',false);
                alert('something is wrong');
            }
        }
    })
});


//for unfollw the user
$(".unfollowbtn").click(function(){
    var user_id_v=$(this).data('userId');
    var button=this;
    $(button).attr('disabled',true);
    $.ajax({
        url:'ajax.php?unfollow',
        method:'post',
        dataType:'json',
        data:{user_id:user_id_v},
        success:function (response){
            if(response.status){
                $(button).data('userId',0);
                $(button).html('<i class="any action to click change"></i>unfollowed');
            }
            else{
                $(button).attr('disabled',false);
            }
        }
    })
});