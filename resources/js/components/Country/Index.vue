<template>
	<div class="main_countries">
		<h1>Страны</h1>
		<template v-if="countries">
			<div  v-for="country in countries" class="hot_prew preview-container">
				<router-link :title="`${country.name}`" :alt="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }" class="prew">
					<img :title="`${country.name}`" :alt="`${country.name}`" :src="`${country.pictureStr}`">
				</router-link>
				<div class="preview-container-right">
					<h3 class="tit_hot">
						<router-link :title="`${country.name}`" :alt="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }">{{ country.name }}</router-link>
					</h3>
					<p><span v-html="country.description"></span><router-link :title="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.slug}` } }"> »»</router-link></p>
				</div>
			</div>
		</template>
	</div>
</template>
<script>
	export default {
		name: 'CountryIndex',
		data() {
			return {
				countries: [],
				errors: null
			};
		},
		mounted() {
			this.getCountries();
		},
		methods:
		{
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
			}
		}
	}
</script>
