<template>
	<div class="main_countries"><h1>Города</h1>
		<template v-if="cities">
			<div  v-for="city in cities" class="hot_prew" :style="{'height': configHeightCityPicture + 'px'}">
				<router-link :title="`${city.name}`" :alt="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }" class="prew">
					<img :title="`${city.name}`" :alt="`${city.name}`" :src="`${city.firstImagePath}`" :width="`${configCityWidthPicture}`" :height="`${configCityHeightPicture}`">
				</router-link>
				<h3 class="tit_hot" :style="{'margin-left':configMarginCityWidthPicture + 'px'}">
					<router-link :title="`${city.name}`" :alt="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }">{{ city.name }}</router-link>
				</h3>
				<p><span v-html="city.description"></span><router-link :title="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }"> »»</router-link></p>
			</div>
		</template>
	</div>
</template>
<script>
	import getConfig from "../../methods/getConfig.js";
	export default {
		name: 'CityIndex',
		data() {
			return {
				cities: [],
				errors: null,
				config: null,
				configHeightCityPicture: 0,
				configCityWidthPicture: 0,
				configCityHeightPicture: 0,
				configMarginCityWidthPicture:0
			};
		},
		mounted() {
			this.getCities();
			this.getPictureParams();
		},
		methods:
		{
			async getPictureParams()
			{
				this.setConfigPicture(await getConfig());
			},
			getCities()
			{
				axios.get('/api/get/cities/')
				.then(res => {
					this.cities = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setConfigPicture(res)
			{
				this.configHeightCityPicture			= parseInt(res.config.foto_height_town) + 10;
				this.configCityWidthPicture				= parseInt(res.config.foto_width_town);
				this.configCityHeightPicture			= parseInt(res.config.foto_height_town);
				this.configMarginCityWidthPicture		= parseInt(res.config.foto_width_town) + 10;
				return false;
			}
		}
	}
</script>
