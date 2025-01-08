<template>
	<div class="main_items">
		<h1>Статьи</h1>
		<template v-if="items">
			<div  v-for="item in items" class="hot_prew preview-container">
				<router-link :title="`${item.name}`" :alt="`${item.name}`" :to="{ name: 'item_id', params: { id: `${item.id}` } }" class="prew">
					<img :title="`${item.name}`" :alt="`${item.name}`" :src="`${item.firstImagePath}`">
				</router-link>
				<div class="preview-container-right">
					<h3 class="tit_hot">
						<router-link :title="`${item.name}`" :alt="`${item.name}`" :to="{ name: 'item_id', params: { id: `${item.id}` } }">{{ item.name }}</router-link>
					</h3>
					<p><span v-html="item.description"></span><router-link :title="`${item.name}`" :alt="`${item.name}`" :to="{ name: 'item_id', params: { id: `${item.id}` } }"> »»</router-link></p>
				</div>
			</div>
		</template>
	</div>
	<div class="clear"></div>
	<div class="pagination" v-if="pagination.length > 3">
		<router-link v-for="link in pagination" :to="link.url" :class="link.active ? 'active name_my_mess' : 'name_my_mess'" v-html="link.label"></router-link>
	</div>
</template>
<script>
	export default {
		name: 'ItemIndex',
		data() {
			return {
				items: [],
				pagination: [],
				errors: null,
				currentPage: 1
			};
		},
		mounted() {
			this.getCurrentPage();
			this.getItems(this.currentPage);
		},
		methods:
		{
			getCurrentPage()
			{
				this.currentPage = typeof(this.$route.query.page) !== 'undefined' ? parseInt(this.$route.query.page) : 1;
				this.currentPage = this.currentPage > 0 ? this.currentPage : 1;
			},
			getItems(currentPage = 1)
			{
				axios.get('/api/get/items/?page=' + currentPage)
				.then(res => {
					this.items		= res.data.data;
					this.pagination	= this.prepareUrls(res.data.meta.links);
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			},
			prepareUrls(ar)
			{
				ar.forEach(function(entry) {
					entry.label = entry.label.replace("Previous", '');
					entry.label = entry.label.replace("Next", '');
				});
				return ar;
			}
		},
		watch: {
        $route(to, from) {
            this.getCurrentPage();
            this.getItems(this.currentPage);
        }
    	},
	}
</script>
