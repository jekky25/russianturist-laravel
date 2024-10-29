<template>
	<div class="main_items_id" v-if="country">
		<h1>{{ country.name }}</h1>
		<div class="hot_prew">
			<div class="country_foto" v-html="country.img"></div>
			<div class="country_r">
				<hotel-short-list :countryId="country.id"></hotel-short-list>
			</div>
			<p v-html="country.description"></p>
		</div>
	</div>
</template>
<script>
	import HotelShortList from "../../components/Hotel/ShortList.vue"
	export default {
		name: 'CountryId',
		components:{
            HotelShortList
        },
		data() {
			return {
				country: null,
				errors: null,
			};
		},
		mounted() {
			this.getCountry(this.$route.params.name);
		},
		methods:
		{
			getCountry(name)
			{
				axios.get('/api/get/country/name/' + name)
				.then(res => {
					this.country = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
		}
	}
</script>
