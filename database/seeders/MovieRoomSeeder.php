<?php
// allora il seeder deve rispettare questi parametri: 
// -movie_id deve esistere dentro al db dei movie
// -data: deve essere una data compresa tra oggi fino a 7 giorni da oggi
// -final_ticket_prize: lo devi calcolare in base al fatto che la room abbia la tecnologia isenso oppure no
// -room_id deve esistere dentro al db dei rooms, inoltre esserci per ogni girono al massimo 1 room_id per slot_id: esempio domani possono esserci fino a 4(numero totale stanze tabella room) stanze (con room_id differenti) per lo stesso slot_id
//slot_id deve esistere dentro al db dei slots, inoltre come per le stanze lo stesso slot_id in un girono non può essere ripetuto più del numero totale delle stanze presenti nella tabella room.
//Generami 100 risultati



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovieRoom;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Slot;
use Carbon\Carbon;

class MovieRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ottieni tutti i dati necessari
        $rooms = Room::all(['id', 'isense', 'base_price']);
        $movies = Movie::all('id');
        $slots = Slot::all('id');

        $today = Carbon::today();
        $endDate = $today->copy()->addDays(14);

        // Creazione delle proiezioni
        for ($i = 0; $i < 100; $i++) {
            // Seleziona casualmente movie_id, slot_id e date
            $movie = $movies->random();
            $slot = $this->randomSlot($slots, $today, $endDate);
            $date = $this->randomDate($today, $endDate); // Restituisce un oggetto Carbon
            $dateString = $date->format('Y-m-d'); // Converti Carbon in stringa 'Y-m-d'

            // Seleziona una stanza che non è già stata utilizzata per lo stesso slot nella stessa data
            $room = $this->randomRoom($rooms, $slot->id, $dateString);

            if (!$room) {
                // Se non ci sono stanze disponibili per lo slot, passa alla prossima iterazione
                continue;
            }

            // Calcola final_ticket_price in base a isense della stanza
            if ($room->isense == 1) {
                $finalTicketPrice = $room->base_price + 3;
            } else {
                $finalTicketPrice = $room->base_price;
            }

            // Crea la nuova proiezione
            $newProjection = new MovieRoom();
            $newProjection->room_id = $room->id;
            $newProjection->movie_id = $movie->id;
            $newProjection->slot_id = $slot->id;
            $newProjection->date = $dateString; // Salva la data come stringa 'Y-m-d'
            $newProjection->final_ticket_price = $finalTicketPrice;
            $newProjection->save();
        }
    }

    /**
     * Genera una data casuale tra $startDate e $endDate.
     *
     * @param  \Carbon\Carbon  $startDate
     * @param  \Carbon\Carbon  $endDate
     * @return \Carbon\Carbon
     */
    private function randomDate($startDate, $endDate)
    {
        $startTimestamp = $startDate->timestamp;
        $endTimestamp = $endDate->timestamp;

        // Assicurati che $endTimestamp sia maggiore o uguale a $startTimestamp
        if ($endTimestamp < $startTimestamp) {
            // Se $endDate è precedente a $startDate, inverti le date
            $temp = $startDate;
            $startDate = $endDate;
            $endDate = $temp;

            $startTimestamp = $startDate->timestamp;
            $endTimestamp = $endDate->timestamp;
        }

        // Genera un timestamp casuale tra $startTimestamp e $endTimestamp
        $timestamp = mt_rand($startTimestamp, $endTimestamp);

        return Carbon::createFromTimestamp($timestamp); // Restituisce un oggetto Carbon
    }

    /**
     * Seleziona casualmente uno slot per il giorno specificato.
     * Ogni slot può essere selezionato fino a 4 volte per giorno.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $slots
     * @param  \Carbon\Carbon  $startDate
     * @param  \Carbon\Carbon  $endDate
     * @return \App\Models\Slot
     */
    private function randomSlot($slots, $startDate, $endDate)
    {
        // Ottieni tutti gli slot disponibili per il giorno specificato
        $availableSlots = $slots->filter(function ($slot) use ($startDate) {
            return true; // Puoi implementare ulteriori logiche di filtro qui se necessario
        });

        // Se non ci sono slot disponibili, aggiungi un nuovo giorno e riprova
        if ($availableSlots->isEmpty()) {
            $startDate->addDay();
            return $this->randomSlot($slots, $startDate, $endDate);
        }

        // Restituisci un slot casuale tra quelli disponibili
        return $availableSlots->random();
    }

    /**
     * Seleziona casualmente una stanza che non è già stata utilizzata per lo stesso slot nella stessa data.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $rooms
     * @param  int  $slotId
     * @param  string  $date
     * @return \App\Models\Room|null
     */
    private function randomRoom($rooms, $slotId, $date)
    {
        // Filtra le stanze che non sono state ancora utilizzate per lo stesso slot nella stessa data
        $availableRooms = $rooms->filter(function ($room) use ($slotId, $date) {
            return !MovieRoom::where('room_id', $room->id)
                ->where('slot_id', $slotId)
                ->where('date', $date)
                ->exists();
        });

        // Verifica se ci sono stanze disponibili
        if ($availableRooms->isEmpty()) {
            return null; // Nessuna stanza disponibile
        }

        // Restituisci una stanza casuale tra quelle disponibili
        return $availableRooms->random();
    }
}
