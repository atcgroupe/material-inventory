import { createApp } from 'vue';
import Reservation from './ReservationList.vue';

const materialList = createApp(Reservation);
materialList.mount('#reservation-list');
