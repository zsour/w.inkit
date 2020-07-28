var checkbox = document.getElementById('policy-checkbox');
var checkoutBtn = document.getElementById('checkout-btn');

checkbox.checked = false;

checkbox.addEventListener('change', () => {
    if(checkbox.checked){
        checkoutBtn.style.opacity = 1;
        checkoutBtn.style.pointerEvents = "all";
    }else{
        checkoutBtn.style.opacity = 0.4;
        checkoutBtn.style.pointerEvents = "none";
    }
});


var inputFields = document.querySelectorAll('.cart-input-field');
inputFields.forEach(element => {
    element.addEventListener('change', () => {
        if(element.value != ''){
            element.style.border = "rgba(0,0,0,0.6) solid 1.5px";
        }
    });
});