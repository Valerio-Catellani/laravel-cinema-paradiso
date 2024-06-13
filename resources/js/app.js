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

//prendo la casella di input
//controllo che esista e se c'è eseguo il codice sottostante

document.querySelectorAll('.upload_image').forEach((element) => {

  element.addEventListener('change', (event) => {
    //console.log(image.files[0]);
    //prendo l'elemento dove visualizzare la preview
    const preview = event.target.parentElement.parentElement.querySelector('.w-25').children[0];
    //creao un nuovo oggetto di tipo FileReader
    const reader = new FileReader();
    //leggo il contenuto del file
    reader.readAsDataURL(event.target.files[0]);
    reader.onload = function (event) {
      preview.src = event.target.result;
    };
  });
})

// sidebar-collapse
document.querySelectorAll('#hype-sidebar-collapse').forEach((element) => {
  element.addEventListener('click', (event) => {
    event.preventDefault();
    const HypeSidebar = document.getElementById('sidebar');
    document.querySelectorAll('.hype-text-collapse').forEach((element) => {
      element.classList.toggle('d-none');
    })
    HypeSidebar.classList.toggle('sidebard-collapse');
  })
})

if (document.getElementById('projections-form')) {

  const roomsNumber = 4;
  const projectionNumber = 3;
  let dateValue = '';
  let getDataResults = '';
  // let getMovieDataResults = '';

  document.getElementById('date').addEventListener('change', (event) => {
    dateValue = event.target.value  //leggo il valore impostato di data dal form
    axios.get('/admin/get-data', {  //chiamo la pagina admin/get-data passandogli il paramentro dataValue. La rotta mi rimanda al controller e alla funzione specifica
      params: { date: dateValue }
    })
      .then(function (response) {
        //console.log(response.data.all_results);   //leggo i risultati restituiti dal controller
        getDataResults = response.data.all_results;   //assegno i risultati alla variabile getDataResults
        let checkRooms = getDataResults.reduce((acc, item) => {    //uso il tipo di reduce per creare un oggetto con i valori di room_id e number_of_time_is_used_for_that_day e li salvo in una vatriabile
          // Se acc[item.room_id] esiste già, incrementa il suo valore di 1.
          // Altrimenti, inizializzalo a 1.
          acc[item.room_id] = (acc[item.room_id] || 0) + 1;
          return acc; // Ritorna l'accumulatore aggiornato per il prossimo ciclo.
        }, {}); // L'accumulatore inizia come un oggetto vuoto.
        console.log(checkRooms);
        Object.entries(checkRooms).forEach(([value, key]) => { //value= room_id, key= number_of_time_is_used_for_that_day (max:projectNumbers)
          if (key >= projectionNumber) {
            document.getElementById(`room-${value}`).disabled = true;
            document.getElementById(`room-${value}`).classList.add('d-none');
          } else {
            document.getElementById(`room-${value}`).disabled = false;
            document.getElementById(`room-${value}`).classList.remove('d-none');
          }
        })
        let checkProjections = getDataResults.reduce((acc, item) => {    //uso il tipo di reduce per creare un oggetto con i valori di slot_id e number_of_time_is_used_for_that_day e li salvo in una vatriabile
          acc[item.slot_id] = (acc[item.slot_id] || 0) + 1;
          return acc;
        }, {});
        Object.entries(checkProjections).forEach(([value, key]) => { //value= slot_id, key= number_of_time_is_used_for_that_day (max:projectNumbers)
          console.log('value', value, 'key', key);
          if (key >= roomsNumber) {
            document.getElementById(`slot-${value}`).disabled = true;
            document.getElementById(`slot-${value}`).classList.add('d-none');
          } else {
            document.getElementById(`slot-${value}`).disabled = false;
            document.getElementById(`slot-${value}`).classList.remove('d-none');
          }
        })
      })
      .catch(function (error) {
        console.error('Si è verificato un errore:', error);
      })
      .finally(function () {
        if (getDataResults.length < (roomsNumber * projectionNumber)) {
          document.getElementById('movie_id').disabled = false;
        }
      });
    // });

    // document.getElementById('movie_id').addEventListener('change', (event) => {
    //   axios.get('/admin/get-data', {
    //     params: {
    //       date: dateValue,
    //       movie_id: event.target.value,
    //     }
    //   })
    //     .then(function (response) {
    //       console.log(response.data.all_results);
    //       getMovieDataResults = response.data.all_results
    //     })
    //     .catch(function (error) {
    //       console.error('Si è verificato un errore:', error);
    //     })
    //     .finally(function () {
    //       document.getElementById('movie_id').disabled = false;
    //     });

  });
}

let editInput = document.querySelectorAll('.edit-input');
let editButton = document.querySelectorAll('.edit-button');
let paragraphs = document.querySelectorAll('.paragraph');
editButton.forEach(function (button) {

    button.addEventListener('click', (e) => {
      e.preventDefault();
      let idButton = button.id.toString();
      
      document.querySelectorAll(`.icon-${idButton}`).forEach((element) => {
        element.classList.toggle('d-none');
      });

        /*  console.log(idButton); */
        editInput.forEach(function (input) {
            /*console.log(post.classList); */
            if (input.classList.contains(idButton)) {
                /*  console.log('true'); */
                input.classList.toggle('d-none');
            }
            else { console.log('idbutton','false') }

        });
        paragraphs.forEach(function (paragraph) {
            let idButton = button.id.toString();
            if (paragraph.classList.contains(idButton)) {
                paragraph.classList.toggle('d-none');
            }
            else { console.log('false') }

        });
    })
})

