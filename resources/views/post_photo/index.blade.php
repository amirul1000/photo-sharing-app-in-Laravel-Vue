@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Post_photo'); ?></h5>

<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="{{route('post_photo.create')}}"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='{{url('post_photo')}}/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center" style="list-style:none;">
			<li class="hide-phone app-search mr-15">
                <form action="{{ route('post_photo.search') }}" method="POST">
                 @csrf
                 @method('GET')
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
               </form>  
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of post_photo-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Post</th>
<th>File Upload</th>

		<th>Actions</th>
    </tr>
	@foreach($post_photo as $c)
    <tr>
		<td><?php
									   $dataArr = DB::table('posts')->where('id', $c->post_id)->get();
									   echo $dataArr[0]->title;?>
									</td>
<td><?php
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

		<td>
            <a href="{{route('post_photo.show',$c->id)}}"  class="action-icon"> <i class="fas fa-eye"></i></a>
            <a href="{{route('post_photo.edit',$c->id)}}" class="action-icon"> <i class="fas fa-edit"></i></a>
            <a href="{{route('post_photo.destroy',$c->id)}}" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fas fa-trash"></i></a>
        </td>
    </tr>
	@endforeach
</table>
</div>
<!--End of Data display of post_photo//--> 

<!--No data-->
<?php
	if(count($post_photo)==0){
?>
 <div align="center"><h3>Data does not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<!--Pagination-->
	{{ $post_photo->links() }}
<!--End of Pagination//-->
<!--End of Pagination//-->
@endsection