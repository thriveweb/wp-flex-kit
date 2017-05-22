<footer class="footer section">
	<div class="container">
		<p>&copy; <?php echo date('Y'); ?> All rights Reserved.</p>
	</div>
</footer>

<?php
wp_footer();

Component::get_all_requested_cp_assets();

?>

</body>
</html>
