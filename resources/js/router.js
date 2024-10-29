import { createWebHistory, createRouter } from "vue-router";

export default createRouter({
	'history' : createWebHistory(),
	routes: [
		{
			path: '/',
			component: () => import('./components/Home/Index'),
			name: 'home'
		},
		{
			path: '/countries/:name.html',
			component: () => import('./components/Home/Index'),
			name: 'country_name',
			props: true
		},
		{
			path: '/countries/',
			component: () => import('./components/Country/Index'),
			name: 'countries'
		},
		{
			path: '/towns/',
			component: () => import('./components/Home/Index'),
			name: 'cities'
		},
		{
			path: '/hotels/:name.html',
			component: () => import('./components/Home/Index'),
			name: 'hotel_name'
		},
		{
			path: '/hotels/',
			component: () => import('./components/Home/Index'),
			name: 'hotels'
		},
		{
			path: '/items/',
			component: () => import('./components/Home/Index'),
			name: 'items'
		}
	]
})