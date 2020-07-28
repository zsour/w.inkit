function flipSwitch(onOrOff, formId, containerId, switchId){
    var switchElement = document.getElementById(switchId);
    var containerElement = document.getElementById(containerId);
    var form = document.getElementById(formId);

    if(onOrOff == 1){
            switchElement.style.right = "20%";
            containerElement.style.backgroundColor = "#979696";
    }else if(onOrOff == 0){
            switchElement.style.right = "-30%";
            containerElement.style.backgroundColor = "#25974b";
    }

    setTimeout(function(){
        form.submit();
    }, 500)
}