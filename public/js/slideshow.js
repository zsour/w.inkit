
class Slideshow{
    constructor(){
        this.imgCount = document.getElementById("slideshow").querySelectorAll(".products-display-slideshow-img");
       
        this.imgArray = [];
        this.imgCount.forEach(element => {
            this.imgArray.push(element);
        });
        
        this.currentSlide = this.imgArray[0];
        this.currentSlide.style.left = "0px";
        this.currentSlide.style.display = "inline-block";
        
    }

    slideshowMoveRight(){
       var currentSlideNum = this.imgArray.indexOf(this.currentSlide);

       this.currentSlide.style.display = "inline-block";
       this.currentSlide.style.left = "-110%";
        
        if(currentSlideNum < (this.imgArray.length - 1)){
            currentSlideNum += 1;
        }else{
        currentSlideNum = 0;
        }
       

        this.currentSlide = this.imgArray[currentSlideNum];
        this.currentSlide.style.display = "inline-block";
        this.currentSlide.style.left = '0px'; 

        setTimeout(() => { 
            if(currentSlideNum == 0){
                this.imgArray[this.imgArray.length-1].style.display = "none";    
                this.imgArray[this.imgArray.length-1].style.left = "110%";
            }else{
                this.imgArray[currentSlideNum-1].style.display = "none";
                this.imgArray[currentSlideNum-1].style.left = "110%";
            }
        }, 400);
    }
}


var slideShow = new Slideshow();
