<!-- JavaScript Libraries -->
<script src="/Assets/js/jquery-1.11.1.min.js"></script>
<script src="/Assets/js/bootstrap.min.js"></script>
<script src="/Assets/js/chart.min.js"></script>
<script src="/Assets/js/chart-data.js"></script>
<script src="/Assets/js/easypiechart.js"></script>
<script src="/Assets/js/easypiechart-data.js"></script>
<script src="/Assets/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/sweetalert2.min.js"></script>
<script src="/Assets/js/bootstrap-table.js"></script>

<!-- Flashdata SweetAlert -->
<script>
	$(document).ready(function () {
		<?php if (session()->getFlashdata('success')) : ?>
			Swal.fire({
				icon: 'success',
				title: 'Success!',
				text: "<?= session()->getFlashdata('success') ?>"
			});
		<?php endif; ?>

		<?php if (session()->getFlashdata('error')) : ?>
			Swal.fire({
				icon: 'error',
				title: 'Sorry!',
				text: "<?= session()->getFlashdata('error') ?>"
			});
		<?php endif; ?>

		<?php if (session()->getFlashdata('warning')) : ?>
			Swal.fire({
				icon: 'warning',
				title: 'Warning!',
				text: "<?= session()->getFlashdata('warning') ?>"
			});
		<?php endif; ?>

		<?php if (session()->getFlashdata('info')) : ?>
			Swal.fire({
				icon: 'info',
				title: 'Info!',
				text: "<?= session()->getFlashdata('info') ?>"
			});
		<?php endif; ?>
	});
</script>

<!-- Custom Sidebar Script -->
<script>
	!function ($) {
		$(document).on("click", "ul.nav li.parent > a > span.icon", function () {
			$(this).find('em:first').toggleClass("glyphicon-minus");
		});
		$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);

	$(window).on('resize', function () {
		if ($(window).width() > 768) {
			$('#sidebar-collapse').collapse('show');
		} else {
			$('#sidebar-collapse').collapse('hide');
		}
	});
</script>

</body>
</html>
