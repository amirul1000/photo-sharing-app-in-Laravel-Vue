<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Friend'); ?></h3>
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
<!--Data display of friend-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>From User</th>
<th>To User</th>
<th>Status</th>
<th>Active</th>

    </tr>
	<?php foreach($friend as $c){ ?>
    <tr>
		<td><?php
									   $dataArr = DB::table('users')->where('id', $c->from_user_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td><?php
									   $dataArr = DB::table('users')->where('id', $c->to_user_id)->get();
									   echo $dataArr[0]->name;?>
									</td>
<td><?=$c->status?></td>
<td><?=$c->active?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of friend//--> 