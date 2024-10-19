@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<a  href="{{ route('category.index') }}" class="btn btn-info"><i class="arrow_left"></i> List</a>

<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','category'); ?></h5>
<!--Data display of category with id--> 
<?php
	$c = $category;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Cat Name</td><td>{{$c->cat_name}}</td>

<tr><td>Description</td><td>{{$c->description}}</td>

<tr><td>Created At</td><td>{{$c->created_at}}</td>

<tr><td>Updated At</td><td>{{$c->updated_at}}</td>


</table>
<!--End of Data display of category with id//--> 
@endsection