@extends('layouts.app')
@section('content')  
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','User'); ?></h5>

<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="{{route('user.create')}}"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='{{url('user')}}/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center" style="list-style:none;">
			<li class="hide-phone app-search mr-15">
                <form action="{{ route('user.search') }}" method="POST">
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
   
<!--Data display of user-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Name</th>
<th>Email</th>
<th>Password</th>
<th>Address</th>
<th>Countrie</th>
<th>State</th>
<th>Citie</th>
<th>Postal Code</th>
<th>Tel</th>
<th>Cell</th>
<th>Subscriber Status</th>
<th>Subscription Date</th>
<th>Gender</th>
<th>Opt In Source</th>
<th>Subscription Type</th>
<th>No Of Emails Can Send</th>
<th>Email Validation Status</th>
<th>Categories</th>
<th>User Type</th>
<th>Created By User</th>
<th>Last Login</th>
<th>Last Campaign</th>
<th>Email Verified At</th>
<th>Remember Token</th>

		<th>Actions</th>
    </tr>
	@foreach($user as $c)
    <tr>
		<td>{{$c->name}}</td>
<td>{{$c->email}}</td>
<td>{{$c->password}}</td>
<td>{{$c->address}}</td>
<td><?php
									   $dataArr = DB::table('countries')->where('id', $c->countrie_id)->get();
									   echo $dataArr[0]->sortname;?>
									</td>
<td><?php
									   $dataArr = DB::table('states')->where('id', $c->state_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td><?php
									   $dataArr = DB::table('cities')->where('id', $c->citie_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td>{{$c->postal_code}}</td>
<td>{{$c->tel}}</td>
<td>{{$c->cell}}</td>
<td>{{$c->subscriber_status}}</td>
<td>{{$c->subscription_date}}</td>
<td>{{$c->gender}}</td>
<td>{{$c->opt_in_source}}</td>
<td>{{$c->subscription_type}}</td>
<td>{{$c->no_of_emails_can_send}}</td>
<td>{{$c->email_validation_status}}</td>
<td>{{$c->categories}}</td>
<td>{{$c->user_type}}</td>
<td><?php
									   $dataArr = DB::table('users')->where('id', $c->created_by_user_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td>{{$c->last_login}}</td>
<td>{{$c->last_campaign}}</td>
<td>{{$c->email_verified_at}}</td>
<td>{{$c->remember_token}}</td>

		<td>
            <a href="{{route('user.show',$c->id)}}"  class="action-icon"> <i class="fas fa-eye"></i></a>
            <a href="{{route('user.edit',$c->id)}}" class="action-icon"> <i class="fas fa-edit"></i></a>
            <a href="{{route('user.destroy',$c->id)}}" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fas fa-trash"></i></a>
        </td>
    </tr>
	@endforeach
</table>
</div>
<!--End of Data display of user//--> 

<!--No data-->
<?php
	if(count($user)==0){
?>
 <div align="center"><h3>Data does not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<!--Pagination-->
	{{ $user->links() }}
<!--End of Pagination//-->
<!--End of Pagination//-->
@endsection