<template>
	<div class="main_items_id" v-if="hotel">
		<h1>{{ hotel.name }} (<router-link :to="{ name: 'city_name', params: { name: `${hotel.city.slug}` } }">{{ hotel.city.name }}</router-link>)</h1>
		<div class="hot_prew">
			<div class="pr_fot_hotel" style="width:150px;" v-if="hotel.pictures">
				<h2>
					<router-link :to="{ name: 'hotel_pictures', params: { name: `${hotel.slug}`, picture:'_picture' } }" :title="`${hotel.name}`" :alt="`${hotel.name}`">Фотографии отеля</router-link>
				</h2>
				<picture-short-list :pictures="hotel.pictures" :hotel="hotel"></picture-short-list>
			</div>
			<p v-html="hotel.description"></p>
		</div>
	</div>
</template>
<script>
	import PictureShortList from "../../components/Picture/ShortList.vue"
	export default {
		name: 'HotelId',
		components:{
			PictureShortList
        },
		data() {
			return {
				hotel: null,
				errors: null
			};
		},
		mounted() {
			this.getHotel(this.$route.params.name);
		},
		methods:
		{
			getHotel(name)
			{
				axios.get('/api/get/hotel/name/' + name)
				.then(res => {
					this.hotel = res.data.data;
					this.setTitle(this.hotel);
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setTitle(item)
			{
				if (item === null) return false;
				window.document.title = item.name + ', отель ' + item.name + ', русский турист, сайт про туризм и путешествия';
			}
		}
	}
</script>
