<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Post_photo'); ?></h3>
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
<!--Data display of post_photo-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Post</th>
<th>File Upload</th>

    </tr>
	<?php foreach($post_photo as $c){ ?>
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

    </tr>
	<?php } ?>
</table>
<!--End of Data display of post_photo//--> 