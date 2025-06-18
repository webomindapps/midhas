import './bootstrap';
import './admin';

import { createApp, defineComponent } from "vue";


import BookATime from "./components/timeslots/BookATime.vue";
import DiscountCoupan from './components/DiscountCoupan.vue';

// Root vue component
const root = defineComponent({});

//Create the app
const app = createApp(root);

app.component('discount-coupan', DiscountCoupan);
app.mount('#discount-app');

app.component("book-time", BookATime);

app.mount("#book-a-time");

