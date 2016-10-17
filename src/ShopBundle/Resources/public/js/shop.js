window.onload = function(){
    function box(){
        var imglist = $("#centerlogo");
        var ww = document.documentElement.clientWidth;
        var w1 = imglist.offsetWidth;
        if(ww <= 1520){
            imglist.removeClass("col-lg-offset-2");
        }else{
            imglist.removeClass("col-lg-offset-1");
            imglist.addClass("col-lg-offset-2");
        }
    }
    box();
    window.onresize = function(){
        box();
    }
};