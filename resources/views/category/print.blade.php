<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','category'); ?></h3>
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
<!--Data display of category-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Cat Name</th>
<th>Description</th>

    </tr>
	<?php foreach($category as $c){ ?>
    <tr>
		<td><?=$c->cat_name?></td>
<td><?=$c->description?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of category//--> 