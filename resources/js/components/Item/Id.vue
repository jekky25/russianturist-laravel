<template>
	<div class="main_items_id" v-if="item">
		<h1>{{ item.name }}</h1>
		<div class="hot_prew">
			<div class="item_foto" v-html="item.img"></div>
			<p v-html="item.description"></p>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'ItemId',
		data() {
			return {
				item: null,
				errors: null,
			};
		},
		mounted() {
			this.getItem(this.$route.params.id);
		},
		methods:
		{
			getItem(id)
			{
				axios.get('/api/get/item/id/' + id)
				.then(res => {
					this.item = res.data.data;
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			}
		}
	}
</script>
