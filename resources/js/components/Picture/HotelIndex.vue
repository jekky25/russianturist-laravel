<template>
	<div class="main_items_id" v-if="hotel">
		<h1>{{ hotel.name }} (<router-link :to="{ name: 'city_name', params: { name: `${hotel.city.slug}` } }">{{ hotel.city.name }}</router-link>)</h1>
		<div class="hot_prew">
			<div class="pr_fot_hotel" style="width:150px;" v-if="hotel.pictures">
				<h2>
					<router-link :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }" :title="`${hotel.name}`" :alt="`${hotel.name}`">Описание отеля</router-link>
				</h2>
				<picture-short-list :pictures="hotel.pictures" :hotel="hotel"></picture-short-list>
			</div>
		</div>
		<div class="foto_big">
			<div class="img-table">
				<div class="img-block"><img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${hotel.pictureSelected.fotoStr}`"></div>
				<div class="img-link-block">
					<router-link :to="{ name: 'hotel_fotos_id', params: { name: `${hotel.slug}`, foto:'_foto_', id: `${hotel.picturePrev.id}` } }" class="no_dec left" v-if="hotel.picturePrev"><< предыдущее</router-link>
					{{ hotel.picturePosition }} / {{ hotel.pictureCount }}
					<router-link :to="{ name: 'hotel_fotos_id', params: { name: `${hotel.slug}`, foto:'_foto_', id: `${hotel.pictureNext.id}` } }" class="no_dec right" v-if="hotel.pictureNext">следуюее >></router-link>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import PictureShortList from "../../components/Picture/ShortList.vue"
	export default {
		name: 'PictureHotelIndex',
		components:{
			PictureShortList
        },
		data() {
				return {
					hotel: null,
					errors: null,
					picture_width:0
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
