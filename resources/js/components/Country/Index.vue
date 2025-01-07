<template>
	<div class="main_countries">
		<h1>Страны</h1>
		<template v-if="countries">
			<div  v-for="country in countries" class="hot_prew" :style="{'height': configHeightCountryPicture + 'px'}">
				<router-link :title="`${country.name}`" :alt="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }" class="prew">
					<img :title="`${country.name}`" :alt="`${country.name}`" :src="`${country.pictureStr}`" :width="`${configCountryWidthPicture}`" :height="`${configCountryHeightPicture}`">
				</router-link>
				<h3 class="tit_hot" :style="{'margin-left':configMarginCountryWidthPicture + 'px'}">
					<router-link :title="`${country.name}`" :alt="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }">{{ country.name }}</router-link>
				</h3>
				<p><span v-html="country.description"></span><router-link :title="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }"> »»</router-link></p>
			</div>
		</template>
	</div>
</template>
<script>
	import getConfig from "../../methods/getConfig.js";
	export default {
		name: 'CountryIndex',
		data() {
			return {
				countries: [],
				errors: null,
				config: null,
				configHeightCountryPicture: 0,
				configCountryWidthPicture: 0,
				configCountryHeightPicture: 0,
				configMarginCountryWidthPicture: 0
			};
		},
		mounted() {
			this.getCountries();
			this.getPictureParams();
		},
		methods:
		{
			async getPictureParams()
			{
				this.setConfigPicture(await getConfig());
			},
			getCountries()
			{
				axios.get('/api/get/countries/')
				.then(res => {
					this.countries = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setConfigPicture(res)
			{
				this.configHeightCountryPicture			= parseInt(res.config.picture_height_country) + 10;
				this.configCountryWidthPicture			= parseInt(res.config.picture_width_country);
				this.configCountryHeightPicture			= parseInt(res.config.picture_height_country);
				this.configMarginCountryWidthPicture	= parseInt(res.config.picture_width_country) + 10;
				return false;
			}
		}
	}
</script>
