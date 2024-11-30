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
		</ul>
	</div>
	<!-- /.sidebar -->
</aside>