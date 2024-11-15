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
			component: () => import('./components/Country/Id'),
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
			component: () => import('./components/City/Index'),
			name: 'cities'
		},
		{
			path: '/towns/:name.html',
			component: () => import('./components/City/Id'),
			name: 'city_name',
			props: true
		},
		{
			path: '/hotels/:name/foto/:id.html',
			component: () => import('./components/Picture/HotelIndexId'),
			name: 'hotel_fotos_id'
		},
		{
			path: '/hotels/:name/foto.html',
			component: () => import('./components/Picture/HotelIndex'),
			name: 'hotel_fotos'
		},
		{
			path: '/hotels/:name.html',
			component: () => import('./components/Hotel/Id'),
			name: 'hotel_name'
		},
		{
			path: '/hotels/',
			component: () => import('./components/Hotel/Index'),
			name: 'hotels'
		},
		{
			path: '/items/item_:id.html',
			component: () => import('./components/Home/Index'),
			name: 'item_id'
		},
		{
			path: '/items/',
			component: () => import('./components/Item/Index'),
			name: 'items'
		}
	]
})