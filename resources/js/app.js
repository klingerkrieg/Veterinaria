import './bootstrap';


/*import { pendingFormConfirmation, confirmDeleteModal, confirmButton } from './main';
window.pendingFormConfirmation = pendingFormConfirmation;
window.confirmDeleteModal = confirmDeleteModal;
window.confirmButton = confirmButton;*/

import * as main from './main'
window.main = main;

import IMask from 'imask';

document.addEventListener("DOMContentLoaded", function(e) {
    
    //Mascara para um unico campo de cpf
    let elements = document.querySelectorAll('.cpf');
    if (elements.length > 0){
        for (var i = 0; i < elements.length; i++){
            IMask(elements[i], {mask: '000.000.000-00'});
        }
    }

    //Mascara para campos de data
    elements = document.querySelectorAll('.date');
    if (elements.length > 0){
        for (var i = 0; i < elements.length; i++){
            IMask(elements[i], {mask: '00/00/0000'});
        }
    }
});

