class NavBarInteraction{
    constructor(buttonID, altID){
        this.buttonID = buttonID;
        this.altID = altID;
    }

    extendNav(){
        var alt = document.getElementById(this.altID);
        var arrowAnimation = document.getElementById(this.buttonID + "-arrow")
        document.getElementById(this.buttonID).addEventListener('click', () =>{    
            if(alt.clientHeight == 0){
                alt.style.height = alt.scrollHeight + "px";
                arrowAnimation.style.transform = "rotate(90deg)";
                arrowAnimation.style.backgroundColor = "#ffffff";
            }
            else{
                alt.style.height = 0;
                arrowAnimation.style.transform = "rotate(0)";
                arrowAnimation.style.backgroundColor = "#ffffff";
            }
        });
    }

    static extendNavStatic(buttonID, altID, transformExtras){
        var alt = document.getElementById(altID);
        
        var arrowAnimation = document.getElementById(buttonID + "-arrow")
        document.getElementById(buttonID).addEventListener('click', () =>{    
            var transfromStatement = (transformExtras) ? transformExtras : " ";
            if(alt.clientHeight == 0){
                alt.style.height = alt.scrollHeight + "px";
                arrowAnimation.style.transform = "rotate(90deg) " + transfromStatement;
            }
            else{
                alt.style.height = 0;
                arrowAnimation.style.transform = "rotate(0deg) " + transfromStatement;
            }
        });
    }
}



var prod_btn = new NavBarInteraction("prod-btn", "prod-alt").extendNav();
var order_btn = new NavBarInteraction("order-btn", "order-alt").extendNav();
var user_btn = new NavBarInteraction("user-btn", "user-alt").extendNav();
var cms_btn = new NavBarInteraction("cms-btn", "cms-alt").extendNav();

class Navigation{
    static loadComponents(URL){
        document.location.href = URL;
    }
}







