<template>
	<div class="main_countries"><h1>Города</h1>
		<template v-if="cities">
			<div  v-for="city in cities" class="hot_prew preview-container">
				<router-link :title="`${city.name}`" :alt="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }" class="prew">
					<img :title="`${city.name}`" :alt="`${city.name}`" :src="`${city.firstImagePath}`">
				</router-link>
				<div class="preview-container-right">
					<h3 class="tit_hot">
						<router-link :title="`${city.name}`" :alt="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }">{{ city.name }}</router-link>
					</h3>
					<p><span v-html="city.description"></span><router-link :title="`${city.name}`" :to="{ name: 'city_name', params: { name: `${city.slug}` } }"> »»</router-link></p>
				</div>
			</div>
		</template>
	</div>
</template>
<script>
	export default {
		name: 'CityIndex',
		data() {
			return {
				cities: [],
				errors: null
			};
		},
		mounted() {
			this.getCities();
		},
		methods:
		{
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
			}
		}
	}
</script>
