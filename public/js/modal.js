class Modal{
        static imgModal(w, h, src, content){
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

            if(content){
                document.getElementById(content).style.overflow = 'hidden';
            }
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
                    popupContainerCancel.addEventListener('click', Modal.closeModal)
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

        static sendShippingInfo(orderId){
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
                    popupContainerCancel.addEventListener('click', Modal.closeModal)
                    popupContainerHeader.appendChild(popupContainerCancel);

                var modalError = document.createElement('div');
                modalError.className = "modalError";
            

                var popupContainerMessageContainer = document.createElement('div');
                popupContainerMessageContainer.className = "popup-container-message";
                    
                    var popupContainerMessage = document.createElement('p');
                    popupContainerMessage.className = "popup-container-message-text";
                    popupContainerMessage.innerHTML = "Input your shipping information: ";
                    popupContainerMessageContainer.appendChild(popupContainerMessage);


                var inputFields = document.createElement('form');
                inputFields.method = 'post';
                inputFields.action = './functionality/send-shipping-information.php';
                    var hiddenField = document.createElement('input');
                    hiddenField.type = "hidden";
                    hiddenField.name = "orderId";
                    hiddenField.value = orderId;
                    inputFields.appendChild(hiddenField);

                    var shippingViaTitle = document.createElement('div');
                    shippingViaTitle.className = "modalInputFieldTitle";
                    shippingViaTitle.innerHTML = "Shipping Via:";
                    inputFields.appendChild(shippingViaTitle);

                    var shippingVia = document.createElement('input');
                    shippingVia.type = "text";
                    shippingVia.name = "shippingVia";
                    shippingVia.spellcheck = false;
                    shippingVia.className = "modalInputField";
                    shippingVia.placeholder = "Enter the name of the delivery service.";
                    inputFields.appendChild(shippingVia);

                    var trackingIdTitle = document.createElement('div');
                    trackingIdTitle.className = "modalInputFieldTitle";
                    trackingIdTitle.innerHTML = "Tracking ID:";
                    inputFields.appendChild(trackingIdTitle);

                    var trackingId = document.createElement('input');
                    trackingId.type = "text";
                    trackingId.name = "trackingId";
                    trackingId.spellcheck = false;
                    trackingId.placeholder = "Enter the tracking id for your order. (Optional)";
                    trackingId.className = "modalInputField";
                    inputFields.appendChild(trackingId);

                var popupContainerButtons = document.createElement('div');
                popupContainerButtons.className = "popup-container-buttons";

                    var popupContainerConfirmBtn = document.createElement('div');
                    popupContainerConfirmBtn.className = "popup-confirm-btn";
                        
                        popupContainerConfirmBtn.addEventListener('click', () => {
                            while (modalError.firstChild) {
                                modalError.removeChild(modalError.firstChild);
                            }
                            var shippingViaCheck = shippingVia.value.replace(/\s/g, '');

                            if(shippingViaCheck  == ""){
                                        shippingVia.value = "";
                                        var modalErrorText = document.createElement('p');
                                        modalErrorText.className = "modalErrorText";
                                        modalErrorText.innerHTML = "Please fill out the input field: Shipping Via"
                                        modalError.appendChild(modalErrorText);
                            }
                            else{
                                inputFields.submit();
                            }
                        }); 

                        var popupContainerConfirmBtnText = document.createElement('p');
                        popupContainerConfirmBtnText.className = "popup-btn-text";
                        popupContainerConfirmBtnText.innerHTML = "Send Shipping Information";
                        popupContainerConfirmBtn.appendChild(popupContainerConfirmBtnText);

                    popupContainerButtons.appendChild(popupContainerConfirmBtn);
                
                popupContainer.appendChild(popupContainerHeader);
                popupContainer.appendChild(modalError);
                popupContainer.appendChild(popupContainerMessageContainer);
                popupContainer.appendChild(inputFields);
                popupContainer.appendChild(popupContainerButtons);

            modalContent.appendChild(popupContainer);
            modalContent.style.opacity = 1;   
        }

        static closeModal(content){
            var modalBG = document.getElementById("modalBG");
            var modalContent = document.getElementById("modalContent");
            modalBG.style.backgroundColor = "rgba(0,0,0,0)";
            modalBG.style.pointerEvents = "none";
            modalContent.style.opacity = 0;
                
                while (modalContent.firstChild) {
                    modalContent.removeChild(modalContent.firstChild);
                }

            if(content){
                document.getElementById(content).style.overflow = '';
            }
        }
}