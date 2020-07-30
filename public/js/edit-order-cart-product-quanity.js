var oldQuantity = document.getElementById('oldQuantity').value;
var oldPrice = document.getElementById('oldPrice').value;
var errorContainer = document.getElementById('errorContainer');

document.getElementById('save-changes').addEventListener('click', () => {
    while (errorContainer.firstChild) {
        errorContainer.removeChild(errorContainer.firstChild);
    }
    var newQuantity = document.getElementById('newQuantity').value;
    if(oldQuantity == newQuantity){
        window.location.href = "./all-orders.php";
    }else if(newQuantity > oldQuantity){
        var newError = document.createElement('div');
        newError.className = "error";
            var errorText = document.createElement('div');
            errorText.id = "error-text-center";
            errorText.innerHTML = "You can only remove products from your order.";
            newError.appendChild(errorText);
        errorContainer.appendChild(newError);
    }else if(newQuantity < oldQuantity){
        var productsOrProduct;
        if((oldQuantity - newQuantity) == 1){
            productsOrProduct = " product";
        }else{
            productsOrProduct = " products";
        }

        console.log(newQuantity);
        Modal.securityCheckModal('form-to-update-product-in-cart', "Are you sure you want to remove " + (oldQuantity - newQuantity)
        + productsOrProduct + " from your order and refund your customer " + (oldPrice * (oldQuantity - newQuantity)) + " &euro;?");
    }
});