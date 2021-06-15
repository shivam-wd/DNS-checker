<?php
if (isset($_POST) && !empty($_POST['domain'])) {
	
	$domain=$_POST['domain'];
	if(dns_check_record($domain, 'A')) {
		$data = dns_get_record($domain, DNS_A);
		if (isset($data) && !empty($data[0])){
			$host = $data[0]['host'];
			$IP = $data[0]['ip'];
			$class = $data[0]['class'];

		}
		
		$data = dns_get_record($domain, DNS_MX);
		if (isset($data) && !empty($data[0])){
		//var_dump($data);die();
		$MX = $data[0]['target'];
	    }

		$data = dns_get_record($domain, DNS_CNAME);
		if (isset($data) && !empty($data[0])){
		//var_dump($data);die();
		$CNAME = $data[0]['target'];
		}

		$data = dns_get_record($domain, DNS_NS);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$NS = $data[0]['target'];
		}

		$data = dns_get_record($domain, DNS_PTR);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$PTR = $data[0]['target'];
		}

		$data = dns_get_record($domain, DNS_SOA);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$SOA = $data[0]['rname'];
		}

		$data = dns_get_record($domain, DNS_SRV);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$SRV = $data[0]['target'];
		}		

		$data = dns_get_record($domain, DNS_HINFO);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$HINFO = $data[0]['target'];
		}

		$data = dns_get_record($domain, DNS_TXT);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$TXT = $data[0]['txt'];
		}

		$data = dns_get_record($domain, DNS_AAAA);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$AAAA = $data[0]['ipv6'];
		}

		$data = dns_get_record($domain, DNS_NAPTR);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$NAPTR = $data[0]['target'];
		}

		$data = dns_get_record($domain, DNS_A6);
		//var_dump($data);die();
		if (isset($data) && !empty($data[0])){
		$A6 = $data[0]['target'];
		}
	}
	else {
		echo 'Invalid domain name!';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DNS tools | Get A record, MX record, CNAME etc</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fa5/css/all.min.css">
	<a href="DNS.php"></a>
	<style type="text/css">
		html, body{
			font-family: 'Times New Roman';
			background-color: white;
		}
		.fa-leaf {
			color: green;
		}
		.jumbotron {
			background-color: #dc3545 !important;
			border-radius: 0px !important;
			padding: 1rem 1rem !important;
			box-shadow: 0px 4px 6px 1px grey;
		}
		.form-control {
			border-radius: 2.25rem !important;
		}
		img {
			max-height: 150px !important;
		}
		.card {
			margin-top: 5px;
			border: 2px solid grey;
		}
		#searchResult {
			
			overflow-y: auto !important; 
			max-height: 500px !important;
		}
	</style>
</head>
<body>
	<div class="jumbotron">
		<div align="center">
			<div class="col-sm-4">
				<h1>DNS tools <span class="fa fa-cog"></span></h1>
				<p>Analyze any domain name here</p>
				<div class="form-group">
					<form method="post" action= ""><input type="text" name="domain" class="form-control" placeholder="mydomain.com, mydomain.in ..."></form>
				</div>
			</div>
		</div>
	</div>
	<div id="searchResult" class="container" >
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><center><span style="font-size: 25px" class="badge badge-primary"><?php echo isset($host) && !empty($host) ? $host : 'No domain'; ?></span></center></h5>
				<p class="card-text"><span class="fa fa-map-marker"></span> <?php echo isset($class) && !empty($class) ? $class : 'Not found'; ?></p>
				<table class="table" >
					<tr>
						<th>A record</th>
						<td><?php echo isset($IP) && !empty($IP) ? $IP : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>CNAME</th>
						<td>www</td>
					</tr>
					<tr>
						<th>MX</th>
						<td><?php echo isset($MX) && !empty($MX) ? $MX : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>NS1</th>
						<td><?php echo isset($NS) && !empty($NS) ? $NS : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>NS2</th>
						<td>ns2.cloudflare.com</td>
					</tr>
					<tr>
						<th>CAA</th>
						<td><?php echo isset($CAA) && !empty($CAA) ? $CAA : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>PTR</th>
						<td><?php echo isset($PTR) && !empty($PTR) ? $PTR : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>SOA</th>
						<td><?php echo isset($SOA) && !empty($SOA) ? $SOA : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>SRV</th>
						<td><?php echo isset($SRV) && !empty($SRV) ? $SRV : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>HINFO</th>
						<td><?php echo isset($HINFO) && !empty($HINFO) ? $HINFO : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>TXT</th>
						<td><?php echo isset($TXT) && !empty($TXT) ? $TXT : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>AAAA</th>
						<td><?php echo isset($AAAA) && !empty($AAAA) ? $AAAA : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>NAPTER</th>
						<td><?php echo isset($NAPTER) && !empty($NAPTER) ? $NAPTER : 'Not found'; ?></td>
					</tr>
					<tr>
						<th>A6</th>
						<td><?php echo isset($A6) && !empty($A6) ? $A6 : 'Not found'; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/fa5/js/all.min.js"></script>
</body>
</html>