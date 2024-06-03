import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);



document.querySelectorAll('.element-delete').forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        const ElementId = element.getAttribute('data-element-id');
        const ElementName = element.getAttribute('data-element-title');
        createModal(ElementId, ElementName);
        const HypeModal = document.getElementById('hype-modal');
        const myModal = new bootstrap.Modal(HypeModal)
        myModal.show();
        const btnSave = HypeModal.querySelector('.modal-delete-button')
        btnSave.addEventListener('click', () => {
            element.parentElement.submit();
            HypeModal.remove();
        })
        const buttons = Array.from(HypeModal.getElementsByTagName('button'));
        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                HypeModal.remove();
            });
        });
    })
})
function createModal(ElementId, ElementName) {
    const modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'hype-modal');
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('aria-labelledby', 'exampleModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    let tmp = `<div class="modal-dialog modal-dialog-centered">
          <div class="modal-content background-gradient-modal text-white hype-shadow-white">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Cancellazione elemento: ${ElementName} - id: ${ElementId}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sei sicuro di voler eliminare l'elemento con id: ${ElementId} e titolo: ${ElementName}?
            </div>
            <div class="modal-footer">
              <button type="button" class="mine-custom-btn min-custom-btn-grey" data-bs-dismiss="modal">No, torna indietro</button>
              <button type="button" class="mine-custom-btn modal-delete-button">Si, cancella</button>
            </div>
          </div>
        </div>`
    modal.innerHTML = tmp;
    document.body.appendChild(modal);
}


