
import './bootstrap';
import { createApp } from 'vue';
import router from "./router";
import User from "./helper/User";
window.User = User;

import Main from "./Main.vue";
import win from "../../public/backend/plugins/uplot/uPlot.esm";
const app = createApp(Main);


app.use(router)



app.mount('#app');
