@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<a  href="{{ route('user.index') }}" class="btn btn-info"><i class="arrow_left"></i> List</a>

<h5 class="font-20 mt-15 mb-1">Update<?php  echo " "; echo str_replace('_',' ','User'); ?></h5>
<!--Form to save data-->
<form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
   @csrf
   @method('PUT')
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
        <label for="Name" class="col-md-4 control-label">Name</label> 
        <div class="col-md-8"> 
         <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Email" class="col-md-4 control-label">Email</label> 
        <div class="col-md-8"> 
         <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Password" class="col-md-4 control-label">Password</label> 
        <div class="col-md-8"> 
         <input type="text" name="password" value="{{$user->password}}" class="form-control" id="password" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Address" class="col-md-4 control-label">Address</label> 
        <div class="col-md-8"> 
         <textarea  name="address"  id="address"  class="form-control" rows="4"/>{{$user->address}}</textarea> 
        </div> 
         </div>
<div class="form-group"> 
       <label for="Countrie" class="col-md-4 control-label">Countrie</label> 
       <div class="col-md-8"> 
        <?php 
           $dataArr = DB::table('countries')->get(); 
        ?> 
        <select name="countrie_id"  id="countrie_id"  class="form-control"/> 
          <option value="">--Select--</option> 
          <?php 
           for($i=0;$i<count($dataArr);$i++) 
           {  
          ?> 
          <option value="<?=$dataArr[$i]->id?>" <?php if($user->countrie_id==$dataArr[$i]->id){ echo "selected";} ?>><?=$dataArr[$i]->sortname?></option> 
          <?php 
           } 
          ?> 
        </select> 
       </div> 
         </div>
<div class="form-group"> 
       <label for="State" class="col-md-4 control-label">State</label> 
       <div class="col-md-8"> 
        <?php 
           $dataArr = DB::table('states')->get(); 
        ?> 
        <select name="state_id"  id="state_id"  class="form-control"/> 
          <option value="">--Select--</option> 
          <?php 
           for($i=0;$i<count($dataArr);$i++) 
           {  
          ?> 
          <option value="<?=$dataArr[$i]->id?>" <?php if($user->state_id==$dataArr[$i]->id){ echo "selected";} ?>><?=$dataArr[$i]->name?></option> 
          <?php 
           } 
          ?> 
        </select> 
       </div> 
         </div>
<div class="form-group"> 
       <label for="Citie" class="col-md-4 control-label">Citie</label> 
       <div class="col-md-8"> 
        <?php 
           $dataArr = DB::table('cities')->get(); 
        ?> 
        <select name="citie_id"  id="citie_id"  class="form-control"/> 
          <option value="">--Select--</option> 
          <?php 
           for($i=0;$i<count($dataArr);$i++) 
           {  
          ?> 
          <option value="<?=$dataArr[$i]->id?>" <?php if($user->citie_id==$dataArr[$i]->id){ echo "selected";} ?>><?=$dataArr[$i]->name?></option> 
          <?php 
           } 
          ?> 
        </select> 
       </div> 
         </div>
<div class="form-group"> 
        <label for="Postal Code" class="col-md-4 control-label">Postal Code</label> 
        <div class="col-md-8"> 
         <input type="text" name="postal_code" value="{{$user->postal_code}}" class="form-control" id="postal_code" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Tel" class="col-md-4 control-label">Tel</label> 
        <div class="col-md-8"> 
         <input type="text" name="tel" value="{{$user->tel}}" class="form-control" id="tel" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Cell" class="col-md-4 control-label">Cell</label> 
        <div class="col-md-8"> 
         <input type="text" name="cell" value="{{$user->cell}}" class="form-control" id="cell" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Subscriber Status" class="col-md-4 control-label">Subscriber Status</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "subscriber_status"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="subscriber_status"  id="subscriber_status"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->subscriber_status==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
          <label for="Subscription Date" class="col-md-4 control-label">Subscription Date</label> 
          <div class="col-md-8"> 
         <input type="date" name="subscription_date"  id="subscription_date"  value="{{$user->subscription_date}}" class="form-control-static datepicker"/> 
          </div> 
         </div>
<div class="form-group"> 
        <label for="Gender" class="col-md-4 control-label">Gender</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "gender"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="gender"  id="gender"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->gender==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
        <label for="Opt In Source" class="col-md-4 control-label">Opt In Source</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "opt_in_source"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="opt_in_source"  id="opt_in_source"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->opt_in_source==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
        <label for="Subscription Type" class="col-md-4 control-label">Subscription Type</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "subscription_type"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="subscription_type"  id="subscription_type"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->subscription_type==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
        <label for="No Of Emails Can Send" class="col-md-4 control-label">No Of Emails Can Send</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "no_of_emails_can_send"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="no_of_emails_can_send"  id="no_of_emails_can_send"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->no_of_emails_can_send==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
        <label for="Email Validation Status" class="col-md-4 control-label">Email Validation Status</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "email_validation_status"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="email_validation_status"  id="email_validation_status"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->email_validation_status==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
        <label for="Categories" class="col-md-4 control-label">Categories</label> 
        <div class="col-md-8"> 
         <textarea  name="categories"  id="categories"  class="form-control" rows="4"/>{{$user->categories}}</textarea> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="User Type" class="col-md-4 control-label">User Type</label> 
        <div class="col-md-8"> 
         <?php 
          
             $type = DB::select('SHOW COLUMNS FROM users WHERE Field = "user_type"')[0]->Type; 
          preg_match("/^enum\((.*)\)$/", $type, $matches); 
          $values = array(); 
          foreach(explode(',', $matches[1]) as $value){ 
           $values[] = trim($value, "'"); 
          } 
           $enumArr = $values; 
         ?> 
         <select name="user_type"  id="user_type"  class="form-control"/> 
           <option value="">--Select--</option> 
           <?php 
            for($i=0;$i<count($enumArr);$i++) 
            { 
           ?> 
           <option value="<?=$enumArr[$i]?>" <?php if($user->user_type==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
           <?php 
            } 
           ?> 
         </select> 
        </div> 
          </div>
<div class="form-group"> 
       <label for="Created By User" class="col-md-4 control-label">Created By User</label> 
       <div class="col-md-8"> 
        <?php 
           $dataArr = DB::table('users')->get(); 
        ?> 
        <select name="created_by_user_id"  id="created_by_user_id"  class="form-control"/> 
          <option value="">--Select--</option> 
          <?php 
           for($i=0;$i<count($dataArr);$i++) 
           {  
          ?> 
          <option value="<?=$dataArr[$i]->id?>" <?php if($user->created_by_user_id==$dataArr[$i]->id){ echo "selected";} ?>><?=$dataArr[$i]->name?></option> 
          <?php 
           } 
          ?> 
        </select> 
       </div> 
         </div>
<div class="form-group"> 
          <label for="Last Login" class="col-md-4 control-label">Last Login</label> 
          <div class="col-md-8"> 
         <input type="date" name="last_login"  id="last_login"  value="{{$user->last_login}}" class="form-control-static datepicker"/> 
          </div> 
         </div>
<div class="form-group"> 
          <label for="Last Campaign" class="col-md-4 control-label">Last Campaign</label> 
          <div class="col-md-8"> 
         <input type="date" name="last_campaign"  id="last_campaign"  value="{{$user->last_campaign}}" class="form-control-static datepicker"/> 
          </div> 
         </div>
<div class="form-group"> 
        <label for="Email Verified At" class="col-md-4 control-label">Email Verified At</label> 
        <div class="col-md-8"> 
         <input type="text" name="email_verified_at" value="{{$user->email_verified_at}}" class="form-control" id="email_verified_at" /> 
        </div> 
         </div>
<div class="form-group"> 
        <label for="Remember Token" class="col-md-4 control-label">Remember Token</label> 
        <div class="col-md-8"> 
         <input type="text" name="remember_token" value="{{$user->remember_token}}" class="form-control" id="remember_token" /> 
        </div> 
         </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</div>
</form>
<!--End of Form to save data//-->	
<!--JQuery-->
@endsection