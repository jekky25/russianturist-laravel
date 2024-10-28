import { createWebHistory, createRouter } from "vue-router";
import PostComponent from './components/PostComponent';
import TagsComponent from './components/TagsComponent';

export default createRouter({
    'history' : createWebHistory(),
    routes: [
        {
            path: '/posts',
            component: PostComponent
        },
        {
            path: '/tags',
            component: TagsComponent
        }
    ]
})
