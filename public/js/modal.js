class Modal{
        static imgModal(w, h, src){
            var modalBG = document.getElementById("modalBG");
            var modalContent = document.getElementById("modalContent");
            modalBG.style.backgroundColor = "rgba(0,0,0,0.8)";
            modalBG.style.pointerEvents = "all";

            var imgTag = document.createElement('img');
            imgTag.height = h;
            imgTag.width = w;
            imgTag.src = src;
            modalContent.appendChild(imgTag);
            modalContent.style.opacity = 1;
        }

        static closeModal(){
            var modalBG = document.getElementById("modalBG");
            var modalContent = document.getElementById("modalContent");
            modalBG.style.backgroundColor = "rgba(0,0,0,0)";
            modalBG.style.pointerEvents = "none";
            modalContent.style.opacity = 0;
                
                while (modalContent.firstChild) {
                    modalContent.removeChild(modalContent.firstChild);
                }
        }
}