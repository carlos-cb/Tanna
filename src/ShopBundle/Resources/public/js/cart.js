$(function(){
    $("a.addnum").click(function(){
        var t = $(this).parent().parent().find('span#_quantity');
        t.html(parseInt(t.text())+1);
        setHeji();
        setTotal();
        var isAdd = 1;
        var cartItemId = parseInt($(this).parent().parent().find('#cartItemId').text());
        var path = $(this).attr("data-path");
        $.ajax({
            type: 'POST',
            url: path,
            data: {val1: isAdd, val2: cartItemId},
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' +  errorThrown);
            }
        });
    });
    $("a.minnum").click(function(){
        var t=$(this).parent().parent().find('span#_quantity');
        t.html(parseInt(t.text())-1);
        if(parseInt(t.text())<2){
            t.html(2);
        }else{
            var isAdd = -1;
            var cartItemId = parseInt($(this).parent().parent().find('#cartItemId').text());
            var path = $(this).attr("data-path");
            $.ajax({
                type: 'POST',
                url: path,
                data: {val1: isAdd, val2: cartItemId},
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error: ' +  errorThrown);
                }
            });
        }
        setHeji();
        setTotal();
    });
    function setHeji(){
        var ff = $('#shangpin').find('tr#order-item');
        for(var j=0; j<ff.length; j++){
            var oferta = parseInt($(ff[j]).find("#oferta").text());
            var maiUnit = parseInt($(ff[j]).find("#maiUnit").text());
            var suanUnit = parseInt($(ff[j]).find("#suanUnit").text());
            var _quantity = parseInt($(ff[j]).find("#_quantity").text());
            if(oferta){
                _quantity = suanUnit * Math.floor(_quantity/maiUnit) + _quantity%maiUnit;
            }
            var s = _quantity * parseFloat($(ff[j]).find("#priceunit").text());
            $(ff[j]).find("#heji").html(s.toFixed(2));
        }
    }
    function setTotal(){
        var totalprice = 0;
        var tt = $('#shangpin').find('tr#order-item');
        for(var i=0; i<tt.length; i++){
            totalprice += parseFloat($(tt[i]).find('#heji').text());
        }
        var total = totalprice;
        $("#totalprice").html(totalprice.toFixed(2));
        $("#total").html(total.toFixed(2));
    }
    setHeji();
    setTotal();
});
