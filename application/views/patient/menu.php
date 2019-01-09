<div class="page-sidebar navbar-collapse collapse">
	<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		<?php if($menutitle==$this->lang->line('patient')) {?>
		<li class="nav-item start active open">
			<?php } else { ?>
			<li class="nav-item">
				<?php } ?>
				<a href="<?=base_url()?>patient" class="nav-link nav-toggle">
					<i class="fa fa-newspaper-o"></i>
					<span class="title">
						病人档案
					</span>
					<span class="arrow"></span>
				</a>
			</li>
		</li>
		</li>
	</ul>
</div>

