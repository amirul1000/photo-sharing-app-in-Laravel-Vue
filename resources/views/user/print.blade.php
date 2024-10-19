<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','User'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of user-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
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

    </tr>
	<?php foreach($user as $c){ ?>
    <tr>
		<td><?=$c->name?></td>
<td><?=$c->email?></td>
<td><?=$c->password?></td>
<td><?=$c->address?></td>
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
<td><?=$c->postal_code?></td>
<td><?=$c->tel?></td>
<td><?=$c->cell?></td>
<td><?=$c->subscriber_status?></td>
<td><?=$c->subscription_date?></td>
<td><?=$c->gender?></td>
<td><?=$c->opt_in_source?></td>
<td><?=$c->subscription_type?></td>
<td><?=$c->no_of_emails_can_send?></td>
<td><?=$c->email_validation_status?></td>
<td><?=$c->categories?></td>
<td><?=$c->user_type?></td>
<td><?php
									   $dataArr = DB::table('users')->where('id', $c->created_by_user_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td><?=$c->last_login?></td>
<td><?=$c->last_campaign?></td>
<td><?=$c->email_verified_at?></td>
<td><?=$c->remember_token?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of user//--> 