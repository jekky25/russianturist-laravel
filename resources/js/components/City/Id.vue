<template>
	<div class="main_items_id" v-if="city">
		<h1>{{ city.name }} (<router-link :to="{ name: 'country_name', params: { name: `${city.country.slug}` } }">{{ city.country.name }}</router-link>)</h1>
		<div class="hot_prew">
			<div class="country_picture">
				<img :title="`${city.name}`" :alt="`${city.name}`" :src="`${city.firstImagePath}`">
			</div>
			<div class="country_r">
				<hotel-short-list :cityId="city.id"></hotel-short-list>
			</div>
			<p v-html="city.description"></p>
		</div>
	</div>
</template>
<script>
	import HotelShortList from "../../components/Hotel/ShortList.vue";
	export default {
		name: 'CityId',
		components:{
            HotelShortList
        },
		data() {
			return {
				city: null,
				errors: null,
			};
		},
		mounted() {
			this.getCity(this.$route.params.name);
		},
		methods:
		{
			getCity(name)
			{
				axios.get('/api/get/city/name/' + name)
				.then(res => {
					this.city = res.data.data;
					this.setTitle(this.city);
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			setTitle(item)
			{
				if (item === null) return false;
				window.document.title = item.name + ', город ' + item.name + ', русский турист, сайт про туризм и путешествия';
			}
		}
	}
</script>
