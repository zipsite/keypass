<!DOCTYPE html>
<html>

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
	</style>
	<link rel="stylesheet" href="{{ mix("css/app.css") }}">
	@routes
</head>