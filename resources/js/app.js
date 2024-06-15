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

if (document.getElementById('projections-form-create')) {

  let roomsNumber = 4;
  let projectionNumber = 3;

  axios.get('/api/get-data', { params: { inforequest: true } }).then(function (response) {
    roomsNumber = response.data.roomsNumber;
    projectionNumber = response.data.slotsNumber;
  }).catch(function (error) {
    console.error('Si è verificato un errore:', error);
  });
  let dateValue = '';
  let getDataResults = '';
  // let getMovieDataResults = '';

  document.getElementById('date').addEventListener('change', (event) => {

    dateValue = event.target.value  //leggo il valore impostato di data dal form
    document.getElementById('room_id').disabled = true;
    document.getElementById('main-room-info').innerHTML = 'Seleziona prima una Data';

    const allOptionRooms = document.querySelectorAll('.option-room');
    if (dateValue === '') {
      allOptionRooms.forEach((element) => {
        element.disabled = true;
        element.classList.add('d-none');
      })
    } else {
      allOptionRooms.forEach((element) => {
        element.disabled = false;
        element.classList.remove('d-none');
      });
      axios.get('/api/get-data', {  //chiamo la pagina admin/get-data passandogli il paramentro dataValue. La rotta mi rimanda al controller e alla funzione specifica
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

            document.getElementById('room_id').disabled = false;
            document.getElementById('main-room-info').innerHTML = 'Seleziona una Stanza';
            document.getElementById('main-slot-info').innerHTML = 'Seleziona prima una Stanza';

          }
        });

    }
  });

  document.getElementById('room_id').addEventListener('change', (event) => {

    //resetto le caselle di input e le visualizzo di default
    document.getElementById('slot_id').disabled = true;
    document.getElementById('main-slot-info').innerHTML = 'Seleziona prima una Stanza';

    const allOptionSlots = document.querySelectorAll('.option-slot');
    if (event.target.value === '') {
      allOptionSlots.forEach((element) => {
        element.disabled = true;
        element.classList.add('d-none');
      })
    } else {
      allOptionSlots.forEach((element) => {
        element.disabled = false;
        element.classList.remove('d-none');
      })
      let roomValue = event.target.value;
      axios.get('/api/get-data', {
        params: { room_id: roomValue, date: dateValue }
      }).then(function (response) {

        getDataResults = response.data.all_results;
        const slotIds = getDataResults.map(item => item.slot_id);
        slotIds.forEach(slotId => {
          document.getElementById(`slot-${slotId}`).disabled = true;
          document.getElementById(`slot-${slotId}`).classList.add('d-none');
        })
      }).catch(function (error) {
        console.error('Si è verificato un errore:', error);
      }).finally(function () {
        document.getElementById('slot_id').disabled = false;
        document.getElementById('main-slot-info').innerHTML = 'Seleziona una Fascia Oraria';

      })
    }
  });
}

if (document.getElementById('projections-form-edit')) {
  let dataValue = document.getElementById('date').value;
  let roomValue = document.getElementById('room_id').value;
  let slotValue = document.getElementById('slot_id').value;
  let roomsNumber = 4;
  let projectionNumber = 3;
  axios.get('/api/get-data', { params: { inforequest: true } }).then(function (response) {
    roomsNumber = response.data.roomsNumber;
    projectionNumber = response.data.slotsNumber;
  }).catch(function (error) {
    console.error('Si è verificato un errore:', error);
  });
  callApiForm(dataValue, projectionNumber, roomsNumber);
  document.getElementById('date').addEventListener('change', (event) => {
    callApiForm(event.target.value, projectionNumber, roomsNumber);
  })



}

function callApiForm(dataValue, projectionNumber, roomsNumber) {
  axios.get('/api/get-data', {  //chiamo la pagina admin/get-data passandogli il paramentro dataValue. La rotta mi rimanda al controller e alla funzione specifica
    params: { date: dataValue, infoEdit: true }
  }).then(function (response) {
    console.log(dataValue);
    console.log(response.data.all_rooms);
    const roomCount = response.data.all_rooms.reduce((counts, element) => {
      counts[element] = (counts[element] || 0) + 1;
      return counts;
    }, {});
    const slotCount = response.data.all_slots.reduce((counts, element) => {
      counts[element] = (counts[element] || 0) + 1;
      return counts;
    }, {});
    Object.entries(roomCount).forEach(([value, key]) => { //value= room_id, key= number_of_time_is_used_for_that_day (max:projectNumbers)
      if (key >= projectionNumber) {
        document.getElementById(`room-${value}`).disabled = true;
        document.getElementById(`room-${value}`).classList.add('d-none');
      } else {
        document.getElementById(`room-${value}`).disabled = false;
        document.getElementById(`room-${value}`).classList.remove('d-none');
      }
    });
    Object.entries(slotCount).forEach(([value, key]) => { //value= slot_id, key= number_of_time_is_used_for_that_day (max:projectNumbers)
      if (key >= roomsNumber) {
        document.getElementById(`slot-${value}`).disabled = true;
        document.getElementById(`slot-${value}`).classList.add('d-none');
      } else {
        document.getElementById(`slot-${value}`).disabled = false;
        document.getElementById(`slot-${value}`).classList.remove('d-none');
      }
    })
  })

}

//SLOT-SHOW
document.querySelectorAll('#search-form-date-slot').forEach((element) => {
  element.querySelectorAll('.input-select-date').forEach((element) => {
    element.addEventListener('change', (event) => {
      element.parentElement.parentElement.submit();
    })
  })
})

document.querySelectorAll('.date-click').forEach((element) => {
  element.addEventListener('click', (event) => {
    const ElementData = element.getAttribute('data-element-date');
    document.querySelectorAll('#select-date').forEach((element) => {
      element.value = ElementData;
      element.dispatchEvent(new Event('change'));
    })
  })
})

