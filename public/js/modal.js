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

        static securityCheckModal(formId, message){
            var modalBG = document.getElementById("modalBG");
            var modalContent = document.getElementById("modalContent");
            modalBG.style.backgroundColor = "rgba(0,0,0,0.8)";
            modalBG.style.pointerEvents = "all";

            var popupContainer = document.createElement('div');
            popupContainer.className = "popup-container";
            
                var popupContainerHeader = document.createElement('div');
                popupContainerHeader.className = "popup-containter-header";

                    var popupContainerCancel = document.createElement('span');
                    popupContainerCancel.className = "popup-header-cancel-icon";
                    popupContainerHeader.appendChild(popupContainerCancel);

                var popupContainerMessageContainer = document.createElement('div');
                popupContainerMessageContainer.className = "popup-container-message";
                    
                    var popupContainerMessage = document.createElement('p');
                    popupContainerMessage.className = "popup-container-message-text";
                    popupContainerMessage.innerHTML = message;
                    popupContainerMessageContainer.appendChild(popupContainerMessage);

                var popupContainerButtons = document.createElement('div');
                popupContainerButtons.className = "popup-container-buttons";

                    var popupContainerConfirmBtn = document.createElement('div');
                    popupContainerConfirmBtn.className = "popup-confirm-btn";
                        
                        popupContainerConfirmBtn.addEventListener('click', () => {
                            document.getElementById(formId).submit();
                        }); 

                        var popupContainerConfirmBtnText = document.createElement('p');
                        popupContainerConfirmBtnText.className = "popup-btn-text";
                        popupContainerConfirmBtnText.innerHTML = "Continue";
                        popupContainerConfirmBtn.appendChild(popupContainerConfirmBtnText);

                    popupContainerButtons.appendChild(popupContainerConfirmBtn);
                
                popupContainer.appendChild(popupContainerHeader);
                popupContainer.appendChild(popupContainerMessageContainer);
                popupContainer.appendChild(popupContainerButtons);

            modalContent.appendChild(popupContainer);
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