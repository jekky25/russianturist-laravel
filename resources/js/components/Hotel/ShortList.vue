<template>
    <div>
        <h2>Новые описания отелей</h2>
		<template v-if="hotels">
			<div  v-for="hotel in hotels" class="hot_prew preview-container">
				<router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }" class="prew">
					<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${hotel.firstImagePath}`">
				</router-link>
				<div class="preview-container-right">
					<h3 class="tit_hot">
						<router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }">
							{{ hotel.shortName }} <span v-html="hotel.starsStr"></span>
						</router-link>
					</h3>
					<p><span v-html="hotel.description"></span><router-link :title="`${hotel.name}`" :to="{ name: 'hotel_name', params: { name: `${hotel.slug}` } }"> »»</router-link></p>
				</div>
			</div>
		</template>
		<div class="hot_prew"></div>
    </div>
</template>

<script>
	export default {
		name: 'HotelShortList',
		data() {
				return {
					hotels: [],
					errors: null,
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
		},
		methods:
		{
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
			}
		}
	}
</script>
