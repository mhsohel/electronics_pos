<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href={{assets('admin_asset/images/logo.png')}} rel="icon">
	<link href={{assets('admin_asset/images/logo.png')}} rel="apple-touch-icon">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link href={{assets('admin_asset/css/bootstrap.min.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/font-awesome/css/font-awesome.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/dataTables/datatables.min.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/footable/footable.core.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/datapicker/datepicker3.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/iCheck/custom.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/steps/jquery.steps.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/select2/select2.min.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/select2/select2-bootstrap4.min.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/chosen/bootstrap-chosen.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/animate.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/style.css')}} rel="stylesheet">
	<link href={{assets('admin_asset/css/plugins/sweetalert/sweetalert.css')}} rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href={{assets('admin_asset/css/plugins/summernote/summernote-bs4.css')}} rel="stylesheet">
</head>

<body>