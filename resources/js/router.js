import { createWebHistory, createRouter } from "vue-router";

export default createRouter({
	'history' : createWebHistory(),
	routes: [
		{
			path: '/',
			component: () => import('./components/Home/Index'),
			name: 'home',
			meta: { 
				title: 'Русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/countries/:name.html',
			component: () => import('./components/Country/Id'),
			name: 'country_name',
			props: true,
			meta: { 
				title: 'Страны, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/countries/',
			component: () => import('./components/Country/Index'),
			name: 'countries',
			meta: { 
				title: 'Страны, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/towns/',
			component: () => import('./components/City/Index'),
			name: 'cities',
			meta: { 
				title: 'Города, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/towns/:name.html',
			component: () => import('./components/City/Id'),
			name: 'city_name',
			props: true,
			meta: { 
				title: 'Города, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/hotels/:name/foto/:id.html',
			component: () => import('./components/Picture/HotelIndexId'),
			name: 'hotel_fotos_id',
			meta: { 
				title: 'Отели, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/hotels/:name/foto.html',
			component: () => import('./components/Picture/HotelIndex'),
			name: 'hotel_fotos',
			meta: { 
				title: 'Отели, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/hotels/:name.html',
			component: () => import('./components/Hotel/Id'),
			name: 'hotel_name',
			meta: { 
				title: 'Отели, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/hotels/',
			component: () => import('./components/Hotel/Index'),
			name: 'hotels',
			meta: { 
				title: 'Отели, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/items/item_:id.html',
			component: () => import('./components/Item/Id'),
			name: 'item_id',
			meta: { 
				title: 'Статьи, русский турист, сайт про туризм и путешествия' 
			}
		},
		{
			path: '/items/',
			component: () => import('./components/Item/Index'),
			name: 'items',
			meta: { 
				title: 'Статьи, русский турист, сайт про туризм и путешествия'
			} 
		}
	]
})