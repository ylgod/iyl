jQuery(document).ready(function($){
    /****二级菜单****/
    navMenuEl = document.getElementById( 'hjyl_menu' );
    subMenu = $('.menu-item-has-children');
    if ( ! subMenu ) {
        return;
    }else{
        var subMenuToggle = $('.sub-menu-toggle');
    $('.sub-menu-toggle').on('click', function(){
        var sMt = subMenuToggle.index(this);
        if('true' !==$(this).attr( 'aria-expanded')){
            $('.hjyl-jump_to_top:eq('+sMt+')').css('display', 'block');
            $('.hjyl-jump_to_bottom:eq('+sMt+')').css('display', 'none');
            $('ul.sub-menu:eq('+sMt+')').css('display', 'block'); 
            $(this).attr( 'aria-expanded', 'true' );
        }else{
            $('.hjyl-jump_to_top:eq('+sMt+')').css('display', 'none');
            $('.hjyl-jump_to_bottom:eq('+sMt+')').css('display', 'block');
            $('ul.sub-menu:eq('+sMt+')').css('display', 'none');    
            $(this).attr( 'aria-expanded', 'false' );
        }
    }); 
    $('.menu-item-has-children').on('hover', function(){
        var sMt = subMenu.index(this);
        console.log(sMt);
        if('true' !==$(this).attr( 'aria-expanded')){
            $('.hjyl-jump_to_top:eq('+sMt+')').css('display', 'block');
            $('.hjyl-jump_to_bottom:eq('+sMt+')').css('display', 'none');
            $('ul.sub-menu:eq('+sMt+')').css('display', 'block'); 
            $(this).attr( 'aria-expanded', 'true' );
        }else{
            $('.hjyl-jump_to_top:eq('+sMt+')').css('display', 'none');
            $('.hjyl-jump_to_bottom:eq('+sMt+')').css('display', 'block');
            $('ul.sub-menu:eq('+sMt+')').css('display', 'none');    
            $(this).attr( 'aria-expanded', 'false' );
        }
    }); 
    }

    /****滑到顶部****/
    $body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');
    $(window).scroll(function(){
        if($(window).scrollTop()>=300){
            $('#hjylUp').fadeIn(600);
        }else{
            $('#hjylUp').fadeOut(600);
    }});
    $('#hjylUp').click(function() {
        $body.animate({
            scrollTop: 0
        }, 600)
    });
    
    $('.close-sidebar').click(function() {
        $('.close-sidebar,#sidebar').hide();
        $('.show-sidebar').show();
        $('#primary').animate({
            width: "95%"
        },
        1000);
        $('.show-sidebar').focus();
    });
    $('.show-sidebar').click(function() {
        $('.show-sidebar').hide();
        $('.close-sidebar,#sidebar').show();
        $('#primary').animate({
            width: "68%"
        },
        1000);
        $('.close-sidebar').focus();
    });

   $(".menu-toggle").on('click', function () {
        $('#hjyl_menu').slideToggle();
        $(this).css('display', 'none');
        $('.menu-close').css('display', 'block');
        $('.menu-close').focus();
   });
   $(".menu-close").on('click', function () {
        $('#hjyl_menu').slideToggle();
        $(this).css('display', 'none');
        $('.menu-toggle').css('display', 'block');
        $('.menu-toggle').focus();
   });

   $("#respond .comment-form-comment #comment").on('click', function(){
        var i = $(this).parent().parent().attr('class');
        var y = $("."+i);
        //console.log(y);
        authorInfo = y.find('#comment-author-info');
        formSumit = y.find('#submit');
        authorInfo.removeClass('screen-reader-text');
        formSumit.removeClass('screen-reader-text');
   });

/****textarea 高度随内容变化****/
    $('textarea').focus(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

/****头部二维码****/
 $('.qrcode').click(function(){
    $('.qrcode').toggleClass('active');
    $('.qrcodeimg').slideToggle();
});

/****外链加上图标****/
$('.entry-content p a').each(function(){
    $self = $(this);
    if(!$self.has('img').length && !$self.hasClass('hjyl_Copy')){
            $self.append('<i class="hjylfont hjyl-share"></i>');
    }
});

});
