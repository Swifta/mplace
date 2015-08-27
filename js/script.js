        // JavaScript Document
var scripts = document.getElementsByTagName("script"),
SrcPath = scripts[1].src;

SrcPath = SrcPath.replace("/js/script.js", "");



$(document).ready(function () {

	    
$('.processing_image').hide();
  $("form").submit( function () {
   $('.processing_image').show();
	$('#submit').hide();
	$('#check2').hide();
   $("input.required").each(function(){
        if ($.trim($(this).val()).length == ""){
             $('.processing_image').hide();
				$('#submit').show();
				$('#check2').show();
            
        }else{
           $('.processing_image').show();
			$('#submit').hide();
			$('#check2').hide();
        }
     } );

} );

	if($('#messagedisplay')){
		$('#messagedisplay').animate({opacity: 1.0}, 8000)
		$('#messagedisplay').fadeOut('slow');
	}
	if($('#error_messagedisplay')){
		$('#error_messagedisplay').animate({opacity: 1.0}, 8000)
		$('#error_messagedisplay').fadeOut('slow');
	}
	
	function blink(selector){
$(selector).fadeOut('slow', function(){
$(this).fadeIn('slow', function(){
blink(this);
});
});
}   
blink('.value_total_in_bid');
blink('.blink');
	  $('.scr_month').hide(); 
     $('.scr_year').hide();
     $('.user_month').hide(); 
     $('.user_year').hide();
     $('.user_ref').hide();
	$('.attribute').hide();
	 $('.tab-attribute').hide();
        
       

		$('.textmessage').click(function(){
			
			var value= $('#textmess').is(':checked')?(value=1):(value=0); 
			$.post(SrcPath+'/admin/autopost/?value='+value, { 

			}, function(response){ 

				
			});

			 
		});



	
	
		$('.textmessage1').click(function(){
			
			var value= $('#textmess1').is(':checked')?(value=1):(value=0);

			$.post(SrcPath+'/merchant/autopost/?value='+value, { 

			}, function(response){ 

				
			});

			 
		});
		
	
		$('.sengrid').click(function(){

			
			var value= $('#sendgrid_1').is(':checked')?(value=1):(value=0); 

			$.post(SrcPath+'/settings/sengrid_emailstatus/?value1='+value, { 

			}, function(response){ 

  			location.reload();
			
			$('#sengrid').show();
			$('#smtp').hide();
			$('#mailchimp').hide();
				
			});


			 
		});
		
		$('.smtp').click(function(){


			
			var value= $('#smtp_1').is(':checked')?(value=2):(value=0); 


			$.post(SrcPath+'/settings/sengrid_emailstatus1/?value1='+value, { 

			}, function(response){ 

  			location.reload();
			$('#sengrid').hide();
			$('#smtp').show();
			$('#mailchimp').hide();

				
			});

					


			 
		});
		
	
		$('.mailchimp').click(function(){


			
			var value= $('#mailchimp_1').is(':checked')?(value=3):(value=0); 


			$.post(SrcPath+'/settings/sengrid_emailstatus2/?value1='+value, { 

			}, function(response){ 

			  location.reload()
			$('#sengrid').hide();
			$('#smtp').hide();
			$('#mailchimp').show();


				
			});

					

			 
		});
		
        $('.toggle').click(function(){
		$(".toggle_s").slideToggle("fast");
	});
	$('.toggle1').click(function(){
		$(".toggle_s1").slideToggle("fast");
	});
	$('.toggle2').click(function(){
	
		var imgSrc = document.getElementById('plus_minus').src;
		imgSrc = imgSrc.substr(-12, 12);
		if(imgSrc == "plus_but.png"){
			document.getElementById('plus_minus').src = "/images/minus_but.png"
		}
		else{
			document.getElementById('plus_minus').src = "/images/plus_but.png"
		}	
		$(".toggle_s2").slideToggle("fast");
	});
	$('.toggle3').click(function(){
		$(".toggle_s3").slideToggle("fast");
	});
		 
 });
 
var win2;
function facebookconnect()
{

  win2 = window.open(SrcPath+'/facebook-post-deals.php',null,'width=750,location=0,status=0,height=500');

  checkChild();    
}

function googleconnect()
{

  //window.open('/facebook-post-deals.php',null,'width=750,location=0,status=0,height=500');

   
}


var win3;
function facebook_connect_post()
{

  win3 = window.open(SrcPath+'/facebookpost.php',null,'width=750,location=0,status=0,height=500');

  checkChild();    
}

function checkChild() {
	  if (win2.closed) {
		window.location.reload(true);
	  } else setTimeout("checkChild()",1);
}

function closeerr(t)
{
	if(t=="err"){
		$("#error_messagedisplay").hide();
	}
	else{
		$("#messagedisplay").hide();
	}
}


function blockunblockCity(country,city,type)
{
	if(country && city){
		window.location.href = SrcPath+"/admin/"+type+"-city/"+country+"/"+city+".html"
	}
	return;
}

function deleteCity(country,city)
{
	if(country && city && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-city/"+country+"/"+city+".html"
	}
	return;
}


function blockunblockCategory(id,catUrl,type)
{
	if(id && catUrl){
		window.location.href = SrcPath+"/admin/"+type+"-category/"+id+"/"+catUrl+".html"
	}
	return;
}



function blockunblockSubCategory(mid,id,catUrl,type)
{
	if(id && catUrl){ 
		window.location.href = SrcPath+"/admin/"+type+"-sub-category/"+mid+"/"+id+"/"+catUrl+".html"
	}
	return;
}

function blockunblocksceSubCategory(sub,id,catUrl,type)
{
	if(id && catUrl){ 
		window.location.href = SrcPath+"/admin/"+type+"-sec-sub-category/"+sub+"/"+id+"/"+catUrl+".html"
	}
	return;
}

function blockunblocksceSecCategory(sub,id,catUrl,type)
{
	if(id && catUrl){ 
		window.location.href = SrcPath+"/admin/"+type+"-third-sub-category/"+sub+"/"+id+"/"+catUrl+".html"
	}
	return;
}

function deleteCategory(id,catUrl)
{
	if(id && catUrl && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/admin/delete-category/"+id+"/"+catUrl+".html"
	}
	return;
}

function subdeleteCategory(id,catUrl)
{
	if(id && catUrl && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/admin/sec-sub-delete-category/"+id+"/"+catUrl+".html"
	}
	return;
}

function thirddeleteCategory(id,catUrl)
{
	if(id && catUrl && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/admin/third-sub-delete-category/"+id+"/"+catUrl+".html"
	}
	return;
}

function changelogoimage(name)
{
	var theme =  document.getElementById('themeselectName').value; 
	document.getElementById('themeImgID').src = SrcPath+"/themes/"+theme+"/images/"+name+".png";
}

function blockunblockUser(id,code,type)
{
	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-user/"+code+"/"+id+".html"
	}
	return;
}

function deleteUser(id,code)
{
	if(id && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-user/"+id+"/"+code+".html"
	}
	return;
}

function blockunblockaffiliate(id,code,type)
{
	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-affiliate/"+code+"/"+id+".html"
	}
	return;
}

function deleteaffiliate(id,code)
{
	if(id && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-affiliate/"+id+"/"+code+".html"
	}
	return;
}


function blockunblockcitylink(id,code,type)
{
	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-citylinks/"+code+"/"+id+".html"
	}
	return;
}

function deletecitylink(id,code)
{
	if(id && code && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-citylinks/"+id+"/"+code+".html"
	}
	return;
}

function blockunblockdeal(id,code,type)
{
	if(id && type && code){
		window.location.href = SrcPath+"/admin/"+type+"-deal/"+code+"/"+id+".html"
	}
	return;
}

function blockunblockauction(id,code,type)
{
	if(id && type && code){
		window.location.href = SrcPath+"/admin/"+type+"-auction/"+code+"/"+id+".html"
	}
	return;
}

function blockunblockmdeal(id,code,type)
{
	if(id && type && code){
		window.location.href = SrcPath+"/merchant/"+type+"-deal/"+code+"/"+id+".html"
	}
	return;
}




function deletedeal(id,code)
{
	if(id && code && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-deal/"+id+"/"+code+".html"
	}
	return;
}

function blockunblocksubscriber1(id,type)
{ 
	if(id && type){

		window.location.href = SrcPath+"/admin/"+type+"-subscribe/"+id+".html"
	}
	return;

}

function deletesubscriber(id)
{

	if(id && confirm('Are you sure want to delete?')){


		window.location.href = SrcPath+"/admin/delete-subscriber/"+id+".html"
	}
	return;
}

function blockunblockFaq(id,type)
{	
	if(id){
		window.location.href = SrcPath+"/faq/"+type+"-faq/"+id;
	}
	return;
}
function deleteFaq(id)
{	
	if(id && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/faq/delete-faq/"+id;

	}
	return;
}

function blockunblockBlog(id,code,type)
{	
	if(id && type && code){
		window.location.href = SrcPath+"/blog/"+type+"-blog/"+code+"/"+id+".html"
	}
	return;
}

function deleteBlog(id,code)
{	
	if(id && code && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/blog/delete-blog/"+id+"/"+code+".html"

	}
	return;
}

function blockunblockCMS(id,code,type)
{	
	if(id && type && code){
		window.location.href = SrcPath+"/cms/"+type+"-cms/"+code+"/"+id+".html"
	}
	return;
}

function deleteCMS(id,code)
{	
	if(id && code && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/cms/delete-cms/"+id+"/"+code+".html"

	}
	return;
}


function deleteContact(id)
{
    if(id && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/admin/delete/"+id+".html"
	}
	return;

}
  


function checkboxcheckAll(form_name,check_all,isO){
	var trk=0;
	var frm = eval('document.'+form_name);
	var check_frm = eval('document.'+form_name+'.'+check_all);

	for (var i=0;i<frm.elements.length;i++){
		var e=frm.elements[i];
		if ((e.name != check_all) && (e.type=='checkbox')){
			if (isO != 1){
				trk++;
				if(e.disabled!=true)
					e.checked=check_frm.checked;
			}
		}
	}
};
function deselectCheckBox(form_name,checkboxelement){
	var frm = eval('document.'+form_name);
	var check_frm = eval('document.'+form_name+'.'+checkboxelement);
	if(check_frm.checked){
		check_frm.checked=false;
	}
};

function enquireystatus(code,id){
    if(code && id){ 
        var url = SrcPath+'/admin/contact-status/'+code+'/'+id+'.html';
    } 
    $.post(url,function(check){ 
        document.getElementById('option'+id).innerHTML = check;
    
    }); 
}
function blockunblockAds(id,type)
{	
	if(id){
		window.location.href = SrcPath+"/admin/"+type+"-ads/"+id;
	}
	return;
}
function deleteAds(id)
{	
	if(id && confirm('Are you sure want to delete?')){
		window.location.href = SrcPath+"/admin/delete-ads/"+id;

	}
	return;
}

function city_change(country){ 
if(country == ''){ var country = -1;  }
	if(country){var url = SrcPath+'/admin_users/CityS/'+country; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		   $("#CitySD").html(check);
		},
		error:function()
		{
			alert('No city has been added under this country.');
		}
	});
}


function city_change_merchant(country){ 
if(country == ''){ var country = -1;  }

	if(country){var url = SrcPath+'/admin_merchant/CityS/'+country; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		   $("#CitySD").html(check);
		},
		error:function()
		{
			alert('No city has been added under this country.');
		}
	});
}

function city_change_merchant_shop(country){ 
if(country == ''){ var country = -1;  }

	if(country){var url = SrcPath+'/merchant/CitySS/'+country; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		   $("#CitySD").html(check);
		},
		error:function()
		{
			alert('No city has been added under this country.');
		}
	});
}

function blockunblockmerchant(id,code,type)
{
	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-merchant/"+code+"/"+id+".html"
	}
	return;
}

function deletemerchant(id,code)
{
	if(id && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-merchant/"+id+"/"+code+".html"
	}
	return;
}

function blockunblockmerchantshop(id,mid,type)
{
	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-merchant-shop/"+id+"/"+mid+".html"
	}
	return;
}




function blockunblockshop(id,type)
{
	if(id && type){
		window.location.href = SrcPath+"/merchant/"+type+"-shop/"+id+".html"
	}
	return;
}

function deletemerchantshop(id,mid)
{
	if(id && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/admin/delete-merchant-shop/"+id+"/"+mid+".html"
	}
	return;
}

/* shop select */

function shop_change(users){ 
if(users == ''){ var users = -1;  }
	if(users){var url = SrcPath+'/admin_deals/shop/'+users; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#shop").html(check);
		},
		error:function()
		{
			alert('No shop has been added under this merchant.');
		}
	});
}

/* shop select */

function shop_products_change(users){ 
if(users == ''){ var users = -1;  }
	if(users){var url = SrcPath+'/admin_products/shop/'+users; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#shop").html(check);
		},
		error:function()
		{
			alert('No product has been added under this merchant.');
		}
	});
}


/* shop select */

function shipping_change(users){ 

if(users == ''){ var users = -1;  }
	if(users){var url = SrcPath+'/admin_products/shipping_type/'+users; }
	$.ajax(
	{ 
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		        $('.wholesaleprice').hide();
		        $('.aramexshipping').hide();
		        $("#check2").show();
		        $("#change_shipping").html(check);
		},
		error:function()
		{
			$("#change_shipping").html('No Shipping shipping method so add under this merchant .');
		}
	});
}
	
	
function shipping_change_pro(users,dealid){ 

if(users == ''){ var users = -1;  }
	if(users){var url = SrcPath+'/admin_products/shipping_type_pro/'+users+'/'+dealid; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		        $('.wholesaleprice').hide();
		        $('.aramexshipping').hide();
		        $("#change_shipping").html(check);
		},
		error:function()
		{
			$("#change_shipping").html('No Shipping shipping method so add under this merchant .');
		}
	});
}
/* category select */

function change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_deals/change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#category").html(check);
		},
		error:function()
		{
			alert('No category has been added under this top category.');
		}
	});
}

function sec_change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_deals/sec_change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sub_category").html(check);
		},
		error:function()
		{
			alert('No main category has been added under this top category.');
		}
	});
}

function third_change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_deals/third_change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sec_category").html(check);
		},
		error:function()
		{
			alert('No sub category has been added under this main category.');
		}
	});
}


function third_change_auction_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_auction/third_change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sec_category").html(check);
		},
		error:function()
		{
			alert('No sub category has been added under this main category.');
		}
	});
}

/* category select */

function change_auction_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_auction/change_category/'+category; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#category").html(check);
		},
		error:function()
		{
			alert('No category has been added under this top category.');
		}
	});
}


function sec_change_auction_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/admin_auction/sec_change_category/'+category; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sub_category").html(check);
		},
		error:function()
		{
			alert('No category has been added under this main category.');
		}
	});
}

function merchant_change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/merchant/merchant_change_category/'+category; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#category").html(check);
		},
		error:function()
		{
			alert('No category has been added under this top category.');
		}
	});
}


function merchant_sec_change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/merchant/merchant_sec_change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sub_category").html(check);
		},
		error:function()
		{
			alert('No main category has been added under this mail category.');
		}
	});
}

function merchant_third_change_category(category){ 

if(category == ''){ var category = -1;  }

	if(category){var url = SrcPath+'/merchant/merchant_third_change_category/'+category; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#sec_category").html(check);
		},
		error:function()
		{
			alert('No sub category has been added under this main category.');
		}
	});
}

// fund delete 
function deletefund(id,amount)
{
	if(id && amount && confirm('Are you sure  want to delete?')){
		window.location.href = SrcPath+"/merchant/delete-fund-request/"+id+"/"+amount;
	}
	return;
}

/** UPDATE FUND REQUEST STATUS**/

function updatefundrequest_status(requestid, userid, type)
{
        if(type==4){
        if(requestid && userid && type==4){
		window.location.href = SrcPath+"/admin/message-fund-request-status/"+requestid+"/"+userid+".html";
	}
	return;
        
        } else {
	if(requestid && userid && type){
		window.location.href = SrcPath+"/admin/update-fund-request-status/"+requestid+"/"+userid+"/"+type+".html";
	}
	return;
	
	}

}

/** PRODUCTS**/
function blockunblockproduct(id,code,type)
{
	if(id && type && code){
		window.location.href = SrcPath+"/admin/"+type+"-products/"+code+"/"+id+".html"
	}
	return;
}

/** MARCHANT PRODUCTS**/
function blockunblockmproduct(id,code,type)
{

	if(id && type && code){
		window.location.href = SrcPath+"/merchant/"+type+"-products/"+code+"/"+id+".html"

	}

	return;
}

/** Merchant Close Deals **/

function close_deal(id,code,type,trans_id,act)
{ 
	if(id && type && code){
		window.location.href =SrcPath+"/merchant/"+type+"-deals/"+code+"/"+id+"/"+trans_id+"/"+act+".html"
	}
	return;
}


/** Admin Close Deals **/

function admin_close_deal(id,code,type,trans_id,act)
{ 
	if(id && type && code){
		window.location.href =SrcPath+"/admin/"+type+"-deals/"+code+"/"+id+"/"+trans_id+"/"+act+".html"
	}
	return;
}

/** Admin Close cod Deals **/

function deal_cod_delivery(code,val,trans_id,d_id,m_id,type)
{
	if(d_id && type && code && m_id && trans_id){
		window.location.href =SrcPath+"/admin/"+type+"-deals-cod/"+code+"/"+d_id+"/"+trans_id+"/"+m_id+"/"+val+".html"
	}
	return;
}

/** Blog Functions **/
	

function blockunblockBlog(id,code,type,redirect)
{
	if(id && code){
		window.location.href = SrcPath+"/admin/"+type+"-blog/"+id+"/"+code+"/"+redirect+".html"
	}
	return;
}

function deleteBlog(id,code,redirect)
{	
	if(id && code && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-blog/"+id+"/"+code+"/"+redirect+".html"

	}
	return;
}

	/** Email Scbscriber**/
function blockunblocksubscriber(id,type)
{ 

	if(id && type){
		window.location.href = SrcPath+"/admin/"+type+"-subscribe/"+id+".html"
	}
	return;

}

function deletesubscriber(id)
{

	if(id && confirm('Are you sure want to delete?')){


		window.location.href = SrcPath+"/admin/delete-subscriber/"+id+".html"
	}
	return;
}

	/** Contacts manage**/

function deletesubcontact(id)
{

	if(id && confirm('Are you sure want to delete?')){


		window.location.href = SrcPath+"/admin/delete-contacts/"+id+".html"
	}
	return;
}


function publishBlog(id,code,type,redirect)
{
	if(id && code){
		window.location.href = SrcPath+"/admin/"+type+"-blog/"+id+"/"+code+"/"+redirect+".html"
	}
	return;
}

	/** Blog Comment Functions **/

function blockunblockComments(id,blog,type)
{
	if(id){
		window.location.href = SrcPath+"/admin/"+type+"-comments/"+id+"/"+blog+".html"
	}
	return;
}
function approvedisapproveComment(id,blog,type)
{
	if(id){
		window.location.href = SrcPath+"/admin/"+type+"-comments/"+id+"/"+blog+".html"
	}
	return;
}

function approvedisapproveMerchant(id,type,tis)
{
	if(id){
		window.location.href = SrcPath+"/admin/"+type+"-merchant/"+id+".html"
	}
	$(tis).hide();
	return;
}

function deleteComments(id,blog)
{
	if(id && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-comments/"+id+"/"+blog+".html"
	}
	return;
}

/** DELETE DEAL COMMENTS **/
function deleteDealComments(id)
{	
	if(id && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-deal-comments/"+id+"/"+".html"
	}
	return;
}

/** DELETE PRODUCT COMMENTS **/
function deleteProductComments(id)
{	
	if(id && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-product-comments/"+id+"/"+".html"
	}
	return;
}

/** DELETE AUCTION COMMENTS **/
function deleteAuctionComments(id)
{	
	if(id && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-auction-comments/"+id+"/"+".html"
	}
	return;
}

/** DELETE STORE COMMENTS **/
function deleteStoreComments(id)
{	
	if(id && confirm('Are you sure you want to delete?')){
		window.location.href = SrcPath+"/admin/delete-store-comments/"+id+"/"+".html"
	}
	return;
}

function forceclose_deal(id,key)
{

	if(id && confirm('Are you sure you want to close the deal?')){

		window.location.href = SrcPath+"/admin/force-close/"+id+"/"+key+".html";
	}
	return;
}


function Transaction_date() {
                $('.scr_date').show();
                $('.scr_month').hide();
                $('.scr_year').hide();
                $("#transactiondate").addClass("selected");
       		    $("#transactionmonth").removeClass("selected");
       		    $("#transactionyear").removeClass("selected");
}
        
function Transaction_month() {
		$('.scr_month').show();
		$('.scr_date').hide();
		$('.scr_year').hide();
		
		$("#transactionmonth").addClass("selected");
		$("#transactiondate").removeClass("selected");
		$("#transactionyear").removeClass("selected");
		
}

function Transaction_year() {
		$('.scr_year').show();
		$('.scr_date').hide();
		$('.scr_month').hide();
		
		$("#transactionyear").addClass("selected");
		$("#transactiondate").removeClass("selected");
		$("#transactionmonth").removeClass("selected");
		
}

function User_date() {
		$('.user_date').show();
		$('.user_month').hide();
		$('.user_year').hide();
		$('.user_ref').hide();
		$('.attribute').hide();
		$('.tab-attribute').hide();
		
		$("#userdate").addClass("selected");
		$("#usermonth").removeClass("selected");
		$("#attribute").removeClass("selected");
		$("#useryear").removeClass("selected");
		$("#reflist").removeClass("selected");
}

function User_ref() {
		$('.user_ref').show();
		$('.user_date').hide();
		$('.user_month').hide();
		$('.attribute').hide();
		$('.user_year').hide();
		$('.tab-attribute').hide();
		
		$("#reflist").addClass("selected");
		$("#userdate").removeClass("selected");
		$("#attribute").removeClass("selected");
		$("#usermonth").removeClass("selected");
		$("#useryear").removeClass("selected");
}

function User_month() {
		$('.user_month').show();
		$('.user_date').hide();
		$('.user_year').hide();
		$('.user_ref').hide();
		$('.attribute').hide();
		$('.tab-attribute').hide();
		
		$("#usermonth").addClass("selected");
		$("#userdate").removeClass("selected");
		$("#useryear").removeClass("selected");
		$("#attribute").removeClass("selected");
		$("#reflist").removeClass("selected");
}

function ShowAttributes() {
		$('.user_month').hide();
		$('.user_date').hide();
		$('.user_year').hide();
		$('.user_ref').hide();
	//	$('.attribute').show();
		$('.tab-attribute').show();
		
		$('input[name="attr_option"]:checked').val()==1?$(".attribute").show():$(".attribute").hide();
		
		$("#attribute").addClass("selected");
		$("#usermonth").removeClass("selected");
		$("#userdate").removeClass("selected");
		$("#useryear").removeClass("selected");
		$("#reflist").removeClass("selected");
}

function User_year() {
		$('.user_year').show();
		$('.user_date').hide();
		$('.attribute').hide();
		$('.user_month').hide();
		$('.user_ref').hide();
		$('.tab-attribute').hide();
		
		$("#useryear").addClass("selected");
		$("#attribute").removeClass("selected");
		$("#userdate").removeClass("selected");
		$("#usermonth").removeClass("selected");
		$("#reflist").removeClass("selected");
}

function checkedcoloradd(fld){

        $('.addcolor').show();
       
        
        return true; 
}

function checkedcolorremove(fld){

        $('.addcolor').hide();
        
        return true; 
}

function checkedsizeadd(fld){

        $('.addsize').show();
        
        return true; 
}


    /*Admin Payment country selection */
function country_change(country){ 
	if(country == ''){ var country = -1;  }
	if(country){var url = SrcPath+'/settings/countryS/'+country; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		     $("#CitySD").html(check);
		},
		error:function()
		{
			
		}
	});
}

        
        

	/* select Email To Send Newsletter */

function user_change(users,type){ 
	if(users && type==1){var url = SrcPath+'/admin_deals/user_select/'+users; }
		
	if(users && type==2){var url = SrcPath+'/admin_products/user_select/'+users; }

	if(users && type==3){var url = SrcPath+'/merchant/user_select/'+users; }

	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#email").html(check);
		},
		error:function()
		{
			alert('No Email Under the Option.');
		}
	});



}


/** PRODUCT SHIPPING DELIVERY **/

function product_shipping_delivery(emailid,name,ship_id,type,acc_type)
{ 
	if(acc_type && emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/merchant/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+".html";
	}
	else if(emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/admin/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+".html";
	}
	
  }

  /** PRODUCT COD DELIVERY **/

function product_cod_delivery(emailid,name,ship_id,type,tran_id,pro_id,mer_id,acc_type)
{ 
	if((acc_type==1) && emailid && name && ship_id && tran_id && pro_id && type)
	{ 
		window.location.href = SrcPath+"/merchant/cod-delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+tran_id+"/"+pro_id+"/"+mer_id+".html";
	}
	else if((acc_type==0) && emailid && name && ship_id && tran_id && pro_id && type)
	{ 
		window.location.href = SrcPath+"/admin/cod-delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+tran_id+"/"+pro_id+"/"+mer_id+".html";
	}
	
  }
  
/** AUCTION SHIPPING DELIVERY **/

function auction_shipping_delivery(emailid,name,ship_id,type,acc_type,a_id,trans_id)
{ 
	if((acc_type==1) && emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/merchant-auction/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+a_id+"/"+trans_id+".html";
	}
	else if(emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/admin-auction/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+a_id+"/"+trans_id+".html";
	}

	return;
	

}

/** AUCTION COD DELIVERY **/

function auction_cod_delivery(emailid,name,ship_id,type,acc_type,a_id,trans_id,m_id)
{ 
	if((acc_type==1) && emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/merchant-auction-cod/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+a_id+"/"+trans_id+"/"+m_id+".html";
	}
	else if(emailid && name && ship_id && type)
	{ 
		window.location.href = SrcPath+"/admin-auction-cod/delivery_status/"+emailid+"/"+name+"/"+type+"/"+ship_id+"/"+a_id+"/"+trans_id+"/"+m_id+".html";
	}

	return;
	

}

function popular_product(productid,tis)
{
	if(productid) {
		
			if($(tis).is(':checked')) { 
				var url = SrcPath+'/admin_products/popular_list/'+productid+'/'+1;  
			} else {
				var url = SrcPath+'/admin_products/popular_list/'+productid+'/'+0;  
			}
			$.ajax(
			{ 
				type:'POST',
				url:url,
				cache:false,
				async:true,
				global:false,

				dataType:"html",
				success:function(check)
				{  
				
				   $("#popu_"+productid).html(check);
				},
				error:function()
				{
					alert('No product Under the Option.');
				}
			});
		
	        }
}


function popular_deals(productid,tis)
{
	if(productid) {
		
			if($(tis).is(':checked')) { 
				var url = SrcPath+'/admin_deals/popular_list/'+productid+'/'+1;  
			} else {
				var url = SrcPath+'/admin_deals/popular_list/'+productid+'/'+0;  
			}
			$.ajax(
			{ 
				type:'POST',
				url:url,
				cache:false,
				async:true,
				global:false,

				dataType:"html",
				success:function(check)
				{  
				
				   $("#popu_"+productid).html(check);
				},
				error:function()
				{
					alert('No product Under the Option.');
				}
			});
		
	        }
}


function popular_auction(productid,tis)
{
	if(productid) {
		
			if($(tis).is(':checked')) { 
				var url = SrcPath+'/admin_auction/popular_list/'+productid+'/'+1;  
			} else {
				var url = SrcPath+'/admin_auction/popular_list/'+productid+'/'+0;  
			}
			$.ajax(
			{ 
				type:'POST',
				url:url,
				cache:false,
				async:true,
				global:false,

				dataType:"html",
				success:function(check)
				{  
				
				   $("#popu_"+productid).html(check);
				},
				error:function()
				{
					alert('No product Under the Option.');
				}
			});
		
	        }
}

function change_dat()
	 {
		 
		var chkval =$('input[name="today"]:checked').val();
				
		if(chkval == 1)
		{
                        $('#startdate').val('');
                        $('#enddate').val('');
                        $('#date_display').hide();
                        $("#startdate").datetimepicker().datetimepicker('disable');
                        $("#enddate").datetimepicker().datetimepicker('disable');			
		}
		else if(chkval == 2)
		{
                        $('#startdate').val('');
                        $('#enddate').val('');
                        $('#date_display').hide();
                        $("#startdate").datetimepicker().datetimepicker('disable');
                        $("#enddate").datetimepicker().datetimepicker('disable');	
		
		}
		else if(chkval == 3)
		{
                        $('#startdate').val('');
                        $('#enddate').val('');
                        $('#date_display').hide();
                        $("#startdate").datetimepicker().datetimepicker('disable');
                        $("#enddate").datetimepicker().datetimepicker('disable');
		}
		else if(chkval == 4)
		{
                        $('#startdate').val('');
                        $('#enddate').val('');
                        $('#date_display').hide();
                        $("#startdate").datetimepicker().datetimepicker('disable');
                        $("#enddate").datetimepicker().datetimepicker('disable');
		}
		else if(chkval == 5)
		{
		        $('#date_display').show();
                        $("#startdate").datetimepicker().datetimepicker('enable');
                        $("#enddate").datetimepicker().datetimepicker('enable');
                        $("#startdate").datetimepicker("option","maxDate", "<?php echo $enddate_date_one; ?>");
                        $("#enddate").datetimepicker("option","minDate", "")
		}
	 }
	 
	 	function validate()
	{	
		if(document.getElementById('date_range').checked) {
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			if(startdate == "" && enddate != "")
			{
				alert("Please Enter From Date");
				return false;
			}
			if(startdate != "" && enddate == "")
			{
				alert("Please Enter To Date");
				return false;
			}
			if(startdate == "" && enddate == "")
			{
				alert("Please Enter From Date and To Date ");
				return false;
			}
		} else {
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			if(startdate != "" && enddate != "")
			{
				alert("Please Select Date Range");
				return false;
			}
			if(startdate != "" && enddate == "")
			{
				alert("Please Enter To Date");
				return false;
			}
			if(startdate == "" && enddate != "")
			{
				alert("Please Enter From Date");
				return false;
			}
		}
	}



