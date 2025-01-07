<template>
	<div class="picture1" v-for="picture in pictures" :style="{'height': configHeightHotelPrew + 'px'}">
		<div :style="{'width': configWidthHotelPrew + 'px', 'padding': 0}">
			<router-link :to="{ name: 'hotel_pictures_id', params: { name: `${hotel.slug}`, picture:'_picture_', id: `${picture.id}` } }" :title="`${hotel.name}`" :alt="`${hotel.name}`" class="prew">
				<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${picture.pictureStr}`" :width="`${configWidthHotelPrew}`" :height="`${configHeightHotelPrew}`" :class="`${picture.active}`" >
			</router-link>
		</div>
	</div>
</template>

<script>
	import getConfig from "../../methods/getConfig.js";
	export default {
		name: 'PictureShortList',
		data() {
				return {
					pictures: null,
					hotel: null,
					errors: null,
					configHeightHotelPrew: 0,
					configWidthHotelPrew: 0
				};
			},
		mounted() {
			this.pictures	= this.$attrs.pictures;
			this.hotel		= this.$attrs.hotel;
			this.getPictureParams();
		},
		methods:
		{
			async getPictureParams()
			{
				this.setConfigPicture(await getConfig());
			},
			async getConfig()
			{
				await axios.get('/api/get/config/')
				.then(res => {
					this.config = res.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setConfigPicture(res)
			{
				this.configHeightHotelPrew			= parseInt(res.config.picture_height_hotel_prew);
				this.configWidthHotelPrew			= parseInt(res.config.picture_width_hotel_prew);
				return false;
			}
		}
	}
</script>
