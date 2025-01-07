<template>
    <div>
        <h2>Новые описания отелей</h2>
		<template v-if="hotels">
			<div  v-for="hotel in hotels" class="hot_prew" :style="{'height': configHeightHotelPicture + 'px'}">
				<router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }" class="prew">
					<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${hotel.firstImagePath}`" :width="`${configHotelWidthPicture}`" :height="`${configHotelHeightPicture}`">
				</router-link>
				<h3 class="tit_hot" :style="{'margin-left':configMarginHotelWidthPicture + 'px'}">
					<router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }">
						{{ hotel.shortName }} <span v-html="hotel.starsStr"></span>
					</router-link>
				</h3>
				<p><span v-html="hotel.description"></span><router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }"> »»</router-link></p>
			</div>
		</template>
		<div class="hot_prew"></div>
    </div>
</template>

<script>
	import getConfig from "../../methods/getConfig.js";
	export default {
		name: 'HotelShortList',
		data() {
				return {
					hotels: [],
					errors: null,
					config: null,
					configHeightHotelPicture: 0,
					configHotelWidthPicture: 0,
					configHotelHeightPicture: 0,
					configMarginHotelWidthPicture: 0,
					countryId:0,
					cityId:0,
					url: null
				};
			},
		mounted() {
			this.countryId	= typeof this.$attrs.countryId !== 'undefined'	? parseInt(this.$attrs.countryId)	: 0;
			this.cityId		= typeof this.$attrs.cityId !== 'undefined'		? parseInt(this.$attrs.cityId)		: 0;
			this.url		= this.cityId > 0								? '/api/get/hotels/short/city/' + this.cityId : '/api/get/hotels/short/' + this.countryId;
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
				axios.get(this.url)
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
				this.configHeightHotelPicture		= parseInt(res.config.picture_height_hotel) + 10;
				this.configHotelWidthPicture		= parseInt(res.config.picture_width_hotel);
				this.configMarginHotelWidthPicture	= parseInt(res.config.picture_width_hotel) + 10;
				this.configHotelHeightPicture		= parseInt(res.config.picture_height_hotel);
				return false;
			}
		}
	}
</script>
