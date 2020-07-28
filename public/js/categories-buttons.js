
var categoryArray = document.querySelectorAll(".all-categories-category");
for(var i = 0; i < categoryArray.length; i++){
    var id = $(categoryArray[i]).attr('id');
    
    try{
        NavBarInteraction.extendNavStatic("category-"+ id.toString() +"-button", "category-" + id.toString());   
    }
    
    catch(err){
        console.log(err);
    }
}

