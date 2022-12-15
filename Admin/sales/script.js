$(document).ready(function(){

			$('#start_date, #end_date').datepicker({
  				todayBtn:'linked',
  				format: "yyyy-mm-dd",
  				autoclose: true
 			});
			
			fetch_data('no');

 			function fetch_data(is_date_search, start_date='', end_date=''){
  				var dataTable = $('#sales_return_table').DataTable({
   					"processing" : true,
   					"serverSide" : true,
   					"order" : [],
   					"ajax" : {
   						url:"fetch_sales_return_data.php",
    					type:"POST",
    					data:{
     						is_date_search: is_date_search, start_date: start_date, end_date: end_date
    					}
   					}
  				});
 			}

 			$('#filter').click(function(){
 				var start_date = $('#start_date').val();
 				var end_date = $('#end_date').val();
 				if(start_date != '' && end_date != ''){
 					$('#sales_return_table').DataTable().destroy();
 					fetch_data('yes', start_date, end_date);

 				}else{
 					swal("Warning","Both Date is Required!","warning");
 				}
 			})
		});


		function getOption(){
			var option="";
			$.ajax({
				url: "../delivery/add_row.php",
				async: false,
				data : {
					add_row:"yes"
				},
				method : "POST",
				dataType: "json",
				success : function(data){
					for(x in data)
					{
						// alert(data[x]);
						option +='<option value="'+ x+'">'+data[x]+'</option>';
						// break;
					}
					// callback(option)			
				},
		
				error: function () {}
			});
			return option;
		}



		$(document).ready(function(){
			var final_total_amount = $('#final_total_amount').text();
			var count = 1;
			$(document).on('click','#add_row', function(){
				count += 1;
				$('#quantity').val(count);
				var html_code = ''; 
				var masa= ''
				html_code += '<tr id="row_id_'+count+'">';
				html_code += '<td <span id="sr-no">'+count+'</span></td>';
	
				html_code += '<td><select name="product_name" id="product_name'+count+'" class="form-control form-control-sm input-sm product_name" placeholder="Products" aria-label="Default select example">';
				
				html_code +=getOption();

				html_code +='</select></div></td>';				
				
				html_code += '<td><input type="number" name="quantity" min="1" id="quantity'+count+'" data-srno="'+count+'" placeholder="0"  class="form-control form-control-sm nput-sm quantity" /></td>';
		
				html_code += '<td><input type="number" name="sell_price" min="0.00" step="0.00" id="sell_price'+count+'" placeholder="Price + Profit" data-srno="'+count+'" class="form-control form-control-sm input-sm sell_price number_only"></td>';	
		
				html_code += '<td><input type="text" name="total_amount" readonly id="total_amount'+count+'" placeholder="Cost * Quantity" data-srno="'+count+'" class="form-control form-control-sm input-sm total_amount"></td>';
		
				// html_code += '<td><input type="text" name="remarks" id="remarks'+count+'" placeholder="Remarks" data-srno="'+count+'" class="form-control form-control-sm input-sm remarks"></td>';
		
				// html_code += '<td><input type="text" name="location" id="location'+count+'" placeholder="Location" data-srno="'+count+'" class="form-control form-control-sm input-sm location"></td>';
		
				html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-sm btn-danger btn-xs remove_row"><i class="fas fa-minus-circle"></i></button></td></tr>';
				// $("#invoice-item-table").val($('#invoice-item-table').val() + html_code);
				// $("#invoice-item-table").append(html_code);
				$('#sales-return-item-table').append(html_code);
				
		
		
			});
			$(document).on('click','.remove_row',function(){
				var row_id = $(this).attr("id");
				var total_product_amount = $('#total_amount'+row_id).val().replace("GHS","");
				var final_amount = $('#final_total_amount').text().replace("GHS","");
				var result_amount = parseFloat(final_amount) - parseFloat(total_product_amount);
				if(isNaN(result_amount)){
		
					if(total_product_amount == ""){
						var total_product_amount = 0;
						var minus_total = parseFloat(final_amount) - parseFloat(total_product_amount);
						$('#total_amount').text('GHS '+minus_total);
					}else{
						$('#final_total_amount').text('GHS 0.00');
					}
					
				}else{
					$('#final_total_amount').text('GHS '+result_amount);
				}
				
				$('#row_id_'+row_id).remove();
				count -= 1;
				$('#quantity').val(count);
			});

			function final_total(count){
				var final_product_amount = 0;
				for(j=1;j<=count;j++){
					var quantity = 0;					
					var sell_price = 0;
					var total_amount = 0;
					var actual_amount = 0;
					quantity = $('#quantity'+j).val();
					if(quantity>0){	
						sell_price = $('#sell_price'+j).val();					
						if(sell_price>0){
							total_amount = parseFloat(quantity).toFixed(2) * parseFloat(sell_price).toFixed(2);
							$('#total_amount'+j).val('GHS '+total_amount);					
							actual_amount = parseFloat(sell_price) * parseFloat(quantity);											
						}						
					}
					final_product_amount += total_amount;
				}
				$('#final_total_amount').text('GHS '+final_product_amount);
			}
			$(document).on('blur', '.sell_price', function(){
				final_total(count);
			});
			$(document).on('click','#create_sales_return',function(){
				var product_name = new Array();
				var quantity = new Array();
				var sell_price = new Array();
				var customer = $('#customer_search').val();
				var credit_note_no = $('#creditnote_no').val();				
				var total = parseFloat($('#final_total_amount').text().replace("GHS","").replace(" ","")).toFixed(2);		
				$('.product_name').each(function(){
					product_name.push($(this).val());
				});
				$('.quantity').each(function(){
					quantity.push($(this).val());
				});
				$('.sell_price').each(function(){
					sell_price.push($(this).val().replace("GHS",""));
				});
		
				if($.trim($('#customer_search').val()).length == 0){
					swal("Warning","Please Enter Customer Name!","warning");
					return false;
				}
				if($.trim($('#creditnote_no').val()).length == 0){
					swal("Warning","Please Enter Sales Return Number !","warning");
					return false;
				}
				for(var no=1; no<=count; no++){
					if($.trim($('#product_name'+no).val()).length == 0){
						swal("Warning","Please Enter Product Name!","warning");
						$('#product_name'+no).focus();
						return false;
					}
					if($.trim($('#quantity'+no).val()).length == 0){
						swal("Warning","Please Enter Product Quantity!","warning");
						$('#quantity'+no).focus();
						return false;
					}
					if($.trim($('#sell_price'+no).val()).length == 0){
						swal("Warning","Please Enter Product Sell Price!","warning");
						$('#product_name'+no).focus();
						return false;
					}
				}
				var sproduct_name = JSON.stringify(product_name); 
				var squantity = JSON.stringify(quantity);
				var ssell_price = JSON.stringify(sell_price);
				var scustomer= customer;
				var scredit_note_no = credit_note_no;				
				var stotal = total;
				$.ajax({
					url: "add.php",
					type: "post",
					data: {product_name : sproduct_name , quantity : squantity, sell_price : ssell_price , customer : scustomer , credit_note_no : scredit_note_no , total : stotal},
					success : function(data){
						if(data=="success"){
							window.location.href='../sales/salesreturn.php?success="1"';
						}else{
							alert(data)
							window.location.href='../sales/add_sales_return.php?failure';
						}
					// alert(data); /* alerts the response from php.*/
					}
					}); 
	
				return false;
		
			})
		});

	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	// $(document).on('click', '.view_data', function(){  
	// 	var id = $(this).attr("id");  
	// 	if(id != ''){  
	// 		$.ajax({  
	// 			url:"view_cashflow.php",  
	// 			method:"POST",  
	// 			data:{id:id},  
	// 			success:function(data){  
	// 				$('#Contact_Details').html(data);  
	// 				$('#dataModal').modal('show');  
	// 			}  
	// 		});  
	// 	}            
	// });   
 });  