<?php
//   include"Config.php";
$select = "SELECT * FROM category ";
$run = mysqli_query($config, $select);

?>


<div class="col-lg-4">
	<div class="card">
		<div class="card-body d-flex right-section">
			<div id="categories">
				<h6>Categories</h6>
				<ul>
					<?php
					while ($cats = mysqli_fetch_assoc($run)) {
					?>
						<li>
							<a href="s_category.php?id=<?= $cats['cat_id'] ?>"><?= $cats['cat_name'] ?> </a>
						</li>
					<?php } ?>
				</ul>
			</div>
			<div id="posts">
				<h6>Recent Posts</h6>
				<ul>
					<li>Blog Title</li>
				</ul>
			</div>
		</div>
	</div>
</div>