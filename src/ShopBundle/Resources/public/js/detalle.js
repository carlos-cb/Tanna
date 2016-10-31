
$(function() {
    $("button#buy").click(function () {

        var path = $(this).attr("data-path");
        var productid = $("div.productid").text();
        var colorid = $("div.colorid").text();
        if(!$("div#size-group label").hasClass("active"))
        {
            alert("Hay que seleccionar una talla por favor.");
        }
        else
        {
            var sizeid = $("div#size-group").find("label.active").attr('id');
            $.ajax({
                type: 'POST',
                url: path,
                data: {id: productid, color: colorid, size: sizeid},
                success: function(){
                    window.location.href = '/order/cart';
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error: ' +  errorThrown);
                }
            });
        }
    });
});
