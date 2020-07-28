var hiddenQuantityInput = document.getElementById('productQuantityHiddenInput');
var textDisplay = document.getElementById('add-to-cart-counter-text');
var currentCount = parseInt(hiddenQuantityInput.value);

textDisplay.innerHTML = currentCount;

function addOne(){
    currentCount += 1;
    hiddenQuantityInput.value = currentCount;
    textDisplay.innerHTML = currentCount;
}

function removeOne(){
    if(currentCount > 1){
        currentCount -= 1;
        hiddenQuantityInput.value = currentCount;
        textDisplay.innerHTML = currentCount;
    }
}