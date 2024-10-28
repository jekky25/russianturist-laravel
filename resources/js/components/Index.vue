<template>
<div class="header">
	<div class="head_l"><router-link title="Русский турист" :to="{ name: 'home' }"><img alt="Русский турист" title="Русский турист" src="image/logo.jpg"></router-link></div>
	<div class="head_c"></div>
	<div class="head_r"></div>
</div>
<div class="main">
	<table>
		<tbody>
			<tr>
				<td class="l_main">
					<template v-if="countries">
					<div class="lm_head"><router-link title="Страны" :to="{ name: 'countries' }">Страны</router-link></div>
					<div class="lm_countr">
						<div class="lm_c1">
							<div>
								<ul>
									<li v-for="country in countries">
										<router-link :title="`${country.name}`" :to="{ name: 'country_name', params: { name: `${country.name}` } }" >{{ country.name }}</router-link>
								
									
									</li>
								</ul>
							</div>
						</div>
					</div>
					</template>
					<template v-if="sape">
						<div class="lm_fri_h">Наши друзья</div>
						<div class="lm_fri_b">
							<div class="lm_fri1">
								<div>
									<ul>
										<li>$item</li>
									</ul>
								</div>
							</div>
						</div>
					</template>
					<div class="lm_foot"></div>
				</td>
				<td class="c_main">
					<table>
						<tbody>
							<tr>
								<td>
									<table>
										<tbody>
											<tr>
												<td class="vert_pm"><div class="rm_head1"></div></td>
												<td class="vert_pm1"><router-link title="Главная" :to="{ name: 'home' }">Главная</router-link></td>
												<td class="vert_pm"></td>
												<td class="vert_pm1"><router-link title="Города" :to="{ name: 'cities' }">Города</router-link></td>
												<td class="vert_pm"></td>
												<td class="vert_pm1"><router-link title="Отели" :to="{ name: 'hotels' }">Отели</router-link></td>
												<td class="vert_pm"></td>
												<td class="vert_pm1"><router-link title="Статьи" :to="{ name: 'items' }">Статьи</router-link></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="9" class="main_tab">
									<!--centr_begin-->
									<div>
										<router-link to="/posts">Posts</router-link>
    						    		<router-link to="/tags">Tags</router-link>
								        <router-view></router-view>
    								</div>
									<!--centr_end-->
									<div class="predupr">При републикации материалов гиперссылка на сайт по туризму www.russianturist.ru обязательна!</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td class="r_main" style="width:19px;">
					<div>
						<div class="rm_head1"></div>
						<div class="rm_head"></div>
						<div class="rm_cent"></div>
						<div class="rm_foot"></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="footer">
	<div class="foot_l">
		<div><img src="image/kompas.jpg" alt="Компас" title="Компас"></div>
	</div>
	<div class="foot_c">
		<div class="foot_c2">
			<span>
			<noindex>
			</noindex>
		</span>
		</div>
		<div class="foot_c1">
			<div class="hh2"><div>2009 Сайт про Российский Туризм и отдых <router-link title="Российский турист" :to="{ name: 'home' }">www.russianturist.ru</router-link></div></div>
		</div>
	</div>
</div>
</template>

<script>
    export default {
		name: "Index",
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
