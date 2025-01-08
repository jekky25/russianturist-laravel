<template>
	<div class="picture1" v-for="picture in pictures">
		<div>
			<router-link :to="{ name: 'hotel_pictures_id', params: { name: `${hotel.slug}`, picture:'_picture_', id: `${picture.id}` } }" :title="`${hotel.name}`" :alt="`${hotel.name}`" class="shot-picture-block-link">
				<img :title="`${hotel.name}`" :alt="`${hotel.name}`" :src="`${picture.pictureStr}`" :class="`${picture.active}`" >
			</router-link>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'PictureShortList',
		data() {
				return {
					pictures: null,
					hotel: null,
					errors: null
				};
			},
		mounted() {
			this.pictures	= this.$attrs.pictures;
			this.hotel		= this.$attrs.hotel;
		},
		methods:
		{

		}
	}
</script>
