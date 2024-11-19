<template>
	<div class="main_countries">
		<h1>Отели</h1>
		<template v-if="hotels">
			<div  v-for="hotel in hotels" class="hot_prew" :style="{'height': configHeightHotelPicture + 'px'}">
				<router-link :title="`${hotel.name}`" :alt="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }" class="prew">
					<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${hotel.fotoStr}`" :width="`${configHotelWidthPicture}`" :height="`${configHotelHeightPicture}`">
				</router-link>
				<h3 class="tit_hot" :style="{'margin-left':configMarginHotelWidthPicture + 'px'}">
					<router-link :title="`${hotel.name}`" :alt="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }">{{ hotel.name }}</router-link>
				</h3>
				<p><span v-html="hotel.description"></span><router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }"> »»</router-link></p>
			</div>
		</template>
	</div>
</template>
<script>
	import getConfig from "../../methods/getConfig.js";
	export default {
		name: 'HotelIndex',
		data() {
			return {
				hotels: [],
				errors: null,
				config: null,
				configHeightHotelPicture: 0,
				configHotelWidthPicture: 0,
				configHotelHeightPicture: 0,
				configMarginHotelWidthPicture: 0
			};
		},
		mounted() {
			this.getHotels();
			this.getPictureParams();
		},
		methods:
		{
			async getPictureParams()
			{
				this.setConfigPicture(await getConfig());
			},
			getHotels()
			{
				axios.get('/api/get/hotels/')
				.then(res => {
					this.hotels = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setConfigPicture(res)
			{
				this.configHeightHotelPicture			= parseInt(res.config.foto_height_hotel) + 10;
				this.configHotelWidthPicture			= parseInt(res.config.foto_width_hotel);
				this.configHotelHeightPicture			= parseInt(res.config.foto_height_hotel);
				this.configMarginHotelWidthPicture		= parseInt(res.config.foto_width_hotel) + 10;
				return false;
			}
		}
	}
</script>
