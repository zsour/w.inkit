
var orderArray = document.querySelectorAll(".all-orders-container");
for(var i = 0; i < orderArray.length; i++){
    var id = $(orderArray[i]).attr('id');
    try{
        NavBarInteraction.extendNavStatic("order-"+ id.toString() +"-button", "order-" + id.toString());   
    }
    
    catch(err){
        console.log(err);
    }
}

