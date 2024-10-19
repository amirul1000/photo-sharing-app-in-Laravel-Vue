@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<a  href="{{ route('post_video.index') }}" class="btn btn-info"><i class="arrow_left"></i> List</a>

<h5 class="font-20 mt-15 mb-1">Save<?php  echo " "; echo str_replace('_',' ','Post_video'); ?></h5>
<!--Form to save data-->
<form action="{{ route('post_video.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
       <label for="Post" class="col-md-4 control-label">Post</label> 
       <div class="col-md-8"> 
        <?php 
           $dataArr = DB::table('posts')->get(); 
        ?> 
        <select name="post_id"  id="post_id"  class="form-control"/> 
          <option value="">--Select--</option> 
          <?php 
           for($i=0;$i<count($dataArr);$i++) 
           {  
          ?> 
          <option value="<?=$dataArr[$i]->id?>"><?=$dataArr[$i]->title?></option> 
          <?php 
           } 
          ?> 
        </select> 
       </div> 
         </div>
<div class="form-group"> 
        <label for="File Upload" class="col-md-4 control-label">File Upload</label> 
        <div class="col-md-8"> 
         <input type="file" name="file_upload"  id="file_upload" value="" class="form-control-file"/> 
        </div> 
          </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>
</form>
<!--End of Form to save data//-->	
<!--JQuery-->
@endsection