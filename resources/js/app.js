import './bootstrap';
import './admin';

import { createApp, defineComponent } from "vue";


import BookATime from "./components/timeslots/BookATime.vue";

// Root vue component
const root = defineComponent({});

//Create the app
const app = createApp(root);


app.component("book-time",BookATime);

app.mount("#book-a-time");

