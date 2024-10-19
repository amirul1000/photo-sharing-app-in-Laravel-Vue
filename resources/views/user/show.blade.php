@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<a  href="{{ route('user.index') }}" class="btn btn-info"><i class="arrow_left"></i> List</a>

<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','User'); ?></h5>
<!--Data display of user with id--> 
<?php
	$c = $user;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Name</td><td>{{$c->name}}</td>

<tr><td>Email</td><td>{{$c->email}}</td>

<tr><td>Password</td><td>{{$c->password}}</td>

<tr><td>Address</td><td>{{$c->address}}</td>

<tr><td>Countrie</td><td><?php
									   $dataArr = $dataArr = DB::table('countries')->where('id', $c->countrie_id)->get();
									   echo $dataArr[0]->sortname;?>
									</td>

<tr><td>State</td><td><?php
									   $dataArr = $dataArr = DB::table('states')->where('id', $c->state_id)->get();
									   echo $dataArr[0]->name;?>
									</td>

<tr><td>Citie</td><td><?php
									   $dataArr = $dataArr = DB::table('cities')->where('id', $c->citie_id)->get();
									   echo $dataArr[0]->name;?>
									</td>

<tr><td>Postal Code</td><td>{{$c->postal_code}}</td>

<tr><td>Tel</td><td>{{$c->tel}}</td>

<tr><td>Cell</td><td>{{$c->cell}}</td>

<tr><td>Subscriber Status</td><td>{{$c->subscriber_status}}</td>

<tr><td>Subscription Date</td><td>{{$c->subscription_date}}</td>

<tr><td>Gender</td><td>{{$c->gender}}</td>

<tr><td>Opt In Source</td><td>{{$c->opt_in_source}}</td>

<tr><td>Subscription Type</td><td>{{$c->subscription_type}}</td>

<tr><td>No Of Emails Can Send</td><td>{{$c->no_of_emails_can_send}}</td>

<tr><td>Email Validation Status</td><td>{{$c->email_validation_status}}</td>

<tr><td>Categories</td><td>{{$c->categories}}</td>

<tr><td>User Type</td><td>{{$c->user_type}}</td>

<tr><td>Created By User</td><td><?php
									   $dataArr = $dataArr = DB::table('users')->where('id', $c->created_by_user_id)->get();
									   echo $dataArr[0]->name;?>
									</td>

<tr><td>Last Login</td><td>{{$c->last_login}}</td>

<tr><td>Last Campaign</td><td>{{$c->last_campaign}}</td>

<tr><td>Email Verified At</td><td>{{$c->email_verified_at}}</td>

<tr><td>Remember Token</td><td>{{$c->remember_token}}</td>

<tr><td>Created At</td><td>{{$c->created_at}}</td>

<tr><td>Updated At</td><td>{{$c->updated_at}}</td>


</table>
<!--End of Data display of user with id//--> 
@endsection