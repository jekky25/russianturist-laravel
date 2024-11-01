<template>
	<div class="main_items_id" v-if="hotel">
		<h1>{{ hotel.name }} (<router-link :to="{ name: 'city_name', params: { name: `${hotel.city.slug}` } }">{{ hotel.city.name }}</router-link>)</h1>
		<div class="hot_prew">
			<div class="pr_fot_hotel" style="width:150px;" v-if="hotel.pictures">
				<h2>
					<router-link :to="{ name: 'hotel_fotos', params: { name: `${hotel.slug}`, foto:'_foto' } }" :title="`${hotel.name}`" :alt="`${hotel.name}`">Фотографии отеля</router-link>
				</h2>
				<div class="foto1" v-for="picture in hotel.pictures" :style="{'height': configHeightHotelPrew + 'px'}">
					<div :style="{'width': configWidthHotelPrew + 'px', 'padding': 0}">
						<router-link :to="{ name: 'hotel_fotos_id', params: { name: `${hotel.slug}`, foto:'_foto_', id: `${picture.id}` } }" :title="`${hotel.name}`" :alt="`${hotel.name}`" class="prew">
							<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${picture.fotoStr}`" :width="`${configWidthHotelPrew}`" :height="`${configHeightHotelPrew}`" :class="`${picture.active}`" >
						</router-link>
					</div>
				</div>
			</div>
			<p v-html="hotel.description"></p>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'HotelId',
		data() {
			return {
				hotel: null,
				errors: null,
				configHeightHotelPrew: 0,
				configWidthHotelPrew: 0
			};
		},
		mounted() {
			this.getHotel(this.$route.params.name);
			this.getConfig();
		},
		methods:
		{
			getHotel(name)
			{
				axios.get('/api/get/hotel/name/' + name)
				.then(res => {
					this.hotel = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			getConfig()
			{
				axios.get('/api/get/config/')
				.then(res => {
					this.config = res.data;
					this.setConfigPicture();
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setConfigPicture()
			{
				this.configHeightHotelPrew			= parseInt(this.config.foto_height_hotel_prew);
				this.configWidthHotelPrew			= parseInt(this.config.foto_width_hotel_prew);
				
				return false;
			}
		}
	}
</script>
