<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Presiden Kelab Dashboard</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		.container {
			margin-top: 50px;
		}

		.small-box {
			border-radius: 10px;
			position: relative;
			padding: 20px;
			color: #fff;
			margin-bottom: 20px;
			cursor: pointer;
			transition: all 0.3s ease-in-out;
		}

		.small-box:hover {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.small-box .icon {
			top: 10px;
			right: 10px;
			z-index: 0;
			font-size: 60px;
			position: absolute;
			transition: all 0.3s linear;
		}

		.small-box .inner {
			padding: 5px 10px;
		}

		.details-box {
			background: #f9f9f9;
			padding: 20px;
			border-radius: 10px;
			margin-bottom: 20px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			display: none;
			/* Initially hidden */
		}

		.details-box h4 {
			margin-bottom: 15px;
		}

		.bg-info {
			background-color: #17a2b8;
		}

		.bg-success {
			background-color: #28a745;
		}

		.bg-warning {
			background-color: #ffc107;
		}

		.bg-danger {
			background-color: #dc3545;
		}
	</style>
</head>

<body>
	<div class="container">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-4 col-12">
				<!-- small box -->
				<div class="small-box bg-info" onclick="toggleDetails('program-details-box')">
					<div class="inner">
						<h3 id="program-count">150</h3>
						<p>Bilangan Program</p>
					</div>
					<div class="icon">
						<i class="fas fa-tasks"></i>
					</div>
					<a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-12">
				<!-- small box -->
				<div class="small-box bg-success" onclick="toggleDetails('members-details-box')">
					<div class="inner">
						<h3 id="members-count">53</h3>
						<p>Bilangan Ahli Kelab</p>
					</div>
					<div class="icon">
						<i class="fas fa-users"></i>
					</div>
					<a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-12">
				<!-- small box -->
				<div class="small-box bg-warning" onclick="toggleDetails('income-details-box')">
					<div class="inner">
						<h3 id="income-count">RM 10,000</h3>
						<p>Pendapatan Kelab</p>
					</div>
					<div class="icon">
						<i class="fas fa-money-bill-wave"></i>
					</div>
					<a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->

		<div class="details-box" id="program-details-box">
			<h4>Program Details</h4>
			<select name="status_filter" class="form-control mb-3" id="status_filter" onchange="updateProgramCount()">
				<option value="">All</option>
				<option value="APPROVED">Approved</option>
				<option value="CANCELLED">Cancelled</option>
				<option value="PENDING">Pending</option>
				<option value="PENDING HEPA APPROVAL">Pending HEPA Approval</option>
				<option value="PENDING MPP APPROVAL">Pending MPP Approval</option>
			</select>
			<p>Total Programs: <span id="filtered-program-count">150</span></p>
			<a href="presiden" class="btn btn-primary">View</a>
		</div>

		<div class="details-box" id="members-details-box">
			<h4>Ahli Kelab Details</h4>
			<p>Active Members: <span id="active-members">30</span></p>
			<p>Non-active Members: <span id="nonactive-members">23</span></p>
			<a href="presiden" class="btn btn-primary">View</a>
		</div>

		<div class="details-box" id="income-details-box">
			<h4>Pendapatan Kelab Details</h4>
			<p>Club Fund: <span id="club-fund">RM 8,000</span></p>
			<p>Other Income: <span id="other-income">RM 2,000</span></p>
			<a href="presiden" class="btn btn-primary">View</a>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		function toggleDetails(id) {
			const box = document.getElementById(id);
			const isVisible = box.style.display === 'block';
			document.querySelectorAll('.details-box').forEach(el => el.style.display = 'none');
			if (!isVisible) {
				box.style.display = 'block';
			}
		}

		function updateProgramCount() {
			const status = document.getElementById('status_filter').value;
			let count;
			switch (status) {
				case 'APPROVED':
					count = 50; // Example number
					break;
				case 'CANCELLED':
					count = 20; // Example number
					break;
				case 'PENDING':
					count = 30; // Example number
					break;
				case 'PENDING HEPA APPROVAL':
					count = 10; // Example number
					break;
				case 'PENDING MPP APPROVAL':
					count = 40; // Example number
					break;
				default:
					count = 150; // Total number of programs
			}
			document.getElementById('filtered-program-count').textContent = count;
		}
	</script>
</body>

</html>