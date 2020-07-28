
function removeImage(url, elementIndex){
    var imageArray = JSON.parse(document.getElementById('imageArray').value);
    var removedImgArray = JSON.parse(document.getElementById('removedImageArray').value);


    var index = imageArray.indexOf(url);

    if(index > -1){
        var removedIndex = imageArray.splice(index, 1);
        removedImgArray.push(removedIndex);
        document.getElementById('removedImageArray').value = JSON.stringify(removedImgArray);
    }
    
    
    document.getElementById('imageArray').value = JSON.stringify(imageArray);
    document.getElementById('imageGallery').removeChild(document.getElementById('image' + elementIndex));
    console.log(document.getElementById('imageArray').value);
    console.log(document.getElementById('removedImageArray').value);
    
}
