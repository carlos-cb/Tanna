
function checkform(){
    var name = document.orderinfo.name.value;
    var phonenumber = document.orderinfo.phonenumber.value;
    var province = document.orderinfo.email.value;
    var city = document.orderinfo.city.value;
    var address = document.orderinfo.address.value;
    var postcode = document.orderinfo.postcode.value;
    if(name.length == 0 || phonenumber.length == 0 || province.length == 0 || city.length == 0 || address.length == 0 || postcode.length == 0){
        alert("Por favor, rellene este formulario.");
        return false;
    }else{
        return true;
    }
}