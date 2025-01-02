<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Sidebar -->
	<div class="sidebar">
		<ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
				<a href="{{route('admin.config.index')}}" class="nav-link">
				<i class="nav-icon fas fa-th-list fa-wrench"></i>
					<p>Настройки</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('admin.user.index')}}" class="nav-link">
				<i class="nav-icon fas fa-user"></i>
					<p>Пользователи</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('admin.country.index')}}" class="nav-link">
				<i class="nav-icon fas fa-flag"></i>
					<p>Страны</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('admin.city.index')}}" class="nav-link">
				<i class="nav-icon fas fa-university"></i>
					<p>Города</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('admin.hotel.index')}}" class="nav-link">
				<i class="nav-icon fas fa-solid fa-building"></i>
					<p>Отели</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('admin.item.index')}}" class="nav-link">
				<i class="nav-icon fas fa-solid fa-scroll"></i>
					<p>Статьи</p>
				</a>
			</li>
		</ul>
	</div>
	<!-- /.sidebar -->
</aside>