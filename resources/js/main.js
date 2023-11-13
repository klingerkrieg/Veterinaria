export var pendingFormConfirmation;

export function confirmDeleteModal(button, description, text){
    var confModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
    confModal.show();
    if (text != null){
        document.querySelector("#confirm_modal_text").innerHTML = text;
    }
    if (description == null){
        document.querySelector("#confirm_modal_reg").innerHTML = "";
    } else {
        document.querySelector("#confirm_modal_reg").innerHTML = '"'+description+'"';
    }
    pendingFormConfirmation = button.parentElement;
}

export function confirmButton(){
    pendingFormConfirmation.submit();
}