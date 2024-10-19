@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<a  href="{{ route('post_video.index') }}" class="btn btn-info"><i class="arrow_left"></i> List</a>

<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Post_video'); ?></h5>
<!--Data display of post_video with id--> 
<?php
	$c = $post_video;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Post</td><td><?php
									   $dataArr = $dataArr = DB::table('posts')->where('id', $c->post_id)->get();
									   echo $dataArr[0]->title;?>
									</td>

<tr><td>File Upload</td><td><?php
											if(is_file(base_path().'/public/'.$c->file_upload)&&file_exists(base_path().'/public/'.$c->file_upload))
											{
										 ?>
										  <img src="<?php echo url($c->file_upload);?>" class="picture_50x50">
										  <?php
											}
											else
											{
										?>
										<img src="<?php echo url('uploads/no_image.jpg');?>" class="picture_50x50">
										<?php		
											}
										  ?>	
										</td>

<tr><td>Created At</td><td>{{$c->created_at}}</td>

<tr><td>Updated At</td><td>{{$c->updated_at}}</td>


</table>
<!--End of Data display of post_video with id//--> 
@endsection