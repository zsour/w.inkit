var errorContainer = document.getElementById('errorContainer');

document.getElementById('save-changes').addEventListener('click', () => {
    while (errorContainer.firstChild) {
        errorContainer.removeChild(errorContainer.firstChild);
    }

    var fullName = document.getElementById('fullName').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var country = document.getElementById('country').value;
    var city = document.getElementById('city').value;
    var zip = document.getElementById('zip').value;
    var address = document.getElementById('address').value;

    var fullNameCheck = fullName.replace(/\s/g, '');
    var emailCheck = email.replace(/\s/g, '');
    var phoneCheck = phone.replace(/\s/g, '');
    var countryCheck = country.replace(/\s/g, '');
    var cityCheck = city.replace(/\s/g, '');
    var zipCheck = zip.replace(/\s/g, '');
    var addressCheck = address.replace(/\s/g, '');

    if(fullNameCheck == "" || emailCheck == "" || phoneCheck == "" || countryCheck == "" ||
    cityCheck == "" || zipCheck == "" || addressCheck == ""){
        var newError = document.createElement('div');
        newError.className = "error";
            var errorText = document.createElement('div');
            errorText.id = "error-text-center";
            errorText.innerHTML = "Please fill out the empty fields.";
            newError.appendChild(errorText);
        errorContainer.appendChild(newError);
    }else if(fullNameCheck == 0 || emailCheck == 0 || phoneCheck == 0 || countryCheck == 0 ||
    cityCheck == 0 || zipCheck == 0 || addressCheck == 0){
        var newError = document.createElement('div');
        newError.className = "error";
            var errorText = document.createElement('div');
            errorText.id = "error-text-center";
            errorText.innerHTML = "No fields can have the value 0.";
            newError.appendChild(errorText);
        errorContainer.appendChild(newError);
    }
    
    else{
        document.getElementById('edit-customer-form').submit();
    }
});

/*
*/