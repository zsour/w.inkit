var imgSettingsContainer = document.getElementById('imgSettingsContainer');
var imgSettingsIcon = document.getElementById('imgSettingsIcon');
var imgContainer = document.getElementById('imageContainer');

imgSettingsIcon.addEventListener('click', () => {
    openOrCloseSettingsContainer();
});

function openOrCloseSettingsContainer(){
    var imgType = document.getElementById('imgType').value;
    clearPreviewImages();
    
    if(imgType = 1){
        addImage(1);
    }else{
        addImage(2);
    }
    
    if(imgSettingsContainer.clientHeight == 0){
        imgSettingsContainer.style.height = "50px";
        
    }else{
        imgSettingsContainer.style.height = "0px";
        clearPreviewImages();
    }
}

function clearPreviewImages(){
    while (imgContainer.firstChild) {
        imgContainer.removeChild(imgContainer.firstChild);
    }
}

function addImage(type){
    if(type == 1){
        var newImage = document.createElement('div');
        newImage.className = "wraped-image";
        imgContainer.appendChild(newImage);
    }
}