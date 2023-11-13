import './bootstrap';


/*import { pendingFormConfirmation, confirmDeleteModal, confirmButton } from './main';
window.pendingFormConfirmation = pendingFormConfirmation;
window.confirmDeleteModal = confirmDeleteModal;
window.confirmButton = confirmButton;*/

import * as main from './main'
window.main = main;

import IMask from 'imask';

document.addEventListener("DOMContentLoaded", function(e) {
    
    const element = document.getElementById('cpf');
    if (element != null){
        const maskOptions = {
        mask: '000.000.000-00'
        };
        const mask = IMask(element, maskOptions);
    }
});

