import './bootstrap';
import { createApp } from 'vue';
import Index from "./components/Index.vue";
import router from "./router.js";
const app = createApp({
    components: {
        el: '#app',
        Index
    }
});
router.beforeEach((toRoute, fromRoute, next) => {
    window.document.title = toRoute.meta && toRoute.meta.title ? toRoute.meta.title : '';
  
    next();
});
app.use(router);
app.mount('#app');