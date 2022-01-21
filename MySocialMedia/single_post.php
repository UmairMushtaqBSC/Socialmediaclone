<?php  include('config.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  include('includes/public_functions.php'); ?>
<?php
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | LifeBlog</title>
</head>
<body>
<div class="container-fluid">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div class="container">
		<div class="content" >
			<!-- Page wrapper -->
			<div class="post-wrapper">
				<!-- full post div -->
				<div class="full-post-div">
				<?php if ($post['published'] == false): ?>
					<h2 class="post-title">Sorry... This post has not been published</h2>
				<?php else: ?>
					<h2 class="post-title"><?php echo $post['title']; ?></h2>
					<div class="post-body-div" style="position: relative;">
						<?php
							echo html_entity_decode($post['body']);
							$conn=mysqli_connect('localhost', 'root', "");
							mysqli_select_db($conn, 'complete-blog-php');
							$bd = $post['body'];
							$vw = ++$post['views'];
							$sql = "UPDATE posts SET views = $vw where body='$bd'";
							$res = mysqli_query($conn, $sql);
						?>
					<label>Hashtags :</label>
					<p><b><?php echo $post['hashtag']; ?></b></p>
					</div>
				<?php endif ?>
				<?php if (isset($_SESSION['user'])): ?>
							<form id="userForm" method="POST">
								<div class="comment-label">
									<label>Comment</label>
									<button class="btn btn-primary" onclick="alert('You Liked The Post')">
										<i onclick="<?php echo html_entity_decode($post['body']);
											$conn=mysqli_connect('localhost', 'root', '');
											mysqli_select_db($conn, 'complete-blog-php');
											$bd = $post['body'];
											$vw = ++$post['likes'];
											$sql = "UPDATE posts SET likes = $vw where body='$bd'";
											$res = mysqli_query($conn, $sql); ?>" class="fa fa-thumbs-up" ></i>
											<span> Like</span>
									</button>
								</div>
								<p id="msg"></p>
								<input type="number" name="post_id" style="display: none;" value="<?php echo $post["id"]; ?>" />
								<input type="text" name="user_name" style="display: none;" value="<?php echo $_SESSION['user']['username']; ?>" />
								<input type="text" name="comment" />
								<div style="display: flex; justify-content: space-between;">
									<p>All comments</p>
									<button type="submit" class="button">Submit</button>
								</div>
								<?php
											$post_id =  $post['id'];
										   $sql = "SELECT * FROM post_comments WHERE post_id='$post_id'";
										  $result = mysqli_query($conn, $sql);
										   // fetch all posts as an associative array called $posts
										  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC); 
										  if ($comments):
											  foreach ($comments as $comment):
									?>
												<p><?php echo $comment["user"]; ?></span>: <?php echo $comment["comment"]; ?></p>
									<?php endforeach ?>
									<?php endif ?>
							</form>
				<?php endif ?>
				<!-- // full post div -->
	
				<!-- comments section -->
				<!--  coming soon ...  -->
			</div>
			<!-- // Page wrapper -->
	
		</div>
		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>
