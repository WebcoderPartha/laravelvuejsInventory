
import './bootstrap';
import { createApp } from 'vue';
import router from "./router";
import Swal from "sweetalert2";
import User from "./helper/User";
import axios from "axios";
import Notification from "./helper/Notification";
window.axios = axios;
window.Swal = Swal;

window.User = User;

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');

// Start Sweet Alert
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    customClass: {
        title: 'sweet_titleImportant',
    }
})
window.Toast = Toast;
// End Sweet Alert

window.Notification = Notification;
import Main from "./Main.vue";





const app = createApp(Main);
app.use(router)



app.mount('#app');
