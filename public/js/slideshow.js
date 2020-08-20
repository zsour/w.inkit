
class Slideshow{
    constructor(){
        this.allImg = document.getElementById('slideshow').querySelectorAll(".products-display-slideshow-img");
        this.allImg[0].style.display = "block";
        this.imgArray = [];
        this.allImg.forEach((element) => {
            this.imgArray.push(element);
        });

        this.currentImage = this.imgArray[0];
    }

    slideshowMoveRight(){  
        var currentImgIndex = this.imgArray.indexOf(this.currentImage);

        if((currentImgIndex + 1) == this.imgArray.length){
            currentImgIndex = 0;
        }else{
            currentImgIndex += 1;
        }

        this.currentImage.style.display = "none";
        this.currentImage = this.imgArray[currentImgIndex];
        console.log(currentImgIndex);
        
        this.currentImage.style.display = "block";
    }

    slideshowMoveLeft(){
        var currentImgIndex = this.imgArray.indexOf(this.currentImage);

        if((currentImgIndex - 1) == -1){
            currentImgIndex = this.imgArray.length - 1;
        }else{
            currentImgIndex -= 1;
        }

        this.currentImage.style.display = "none";
        this.currentImage = this.imgArray[currentImgIndex];
        console.log(currentImgIndex);
        
        this.currentImage.style.display = "block";
    }

    largeOnClick(){
        
    }
}


var slideshow = new Slideshow();