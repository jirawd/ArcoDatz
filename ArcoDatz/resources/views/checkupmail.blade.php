<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
</head>
<body>
	<h1>{{ $data->title }}</h1>

<p>hello {{ $data->customername }}, I am {{ $data->sender }}</p>
<p>Your pet,{{ $data->petname }}</p>
<p> has a disease called {{ $data->disease }}.</p> 


<p>this is a test message</p>
<a href="{{url('/')}}">{{url('/')}}</a>


</body>
</html>