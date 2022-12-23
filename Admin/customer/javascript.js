$(function () {
  		$('[data-toggle="popover"]').popover()
	});
	$(function(){
		$('button.delete').click(function(e){
			e.preventDefault();
			var link = this;
			var deleteModal = $("#deleteModal");
			deleteModal.find('input[name=id]').val(link.dataset.id);
			deleteModal.modal();
		});
	});
	$(function(){
		$('button.restore').click(function(e){
			e.preventDefault();
			var link = this;
			var restoreModal = $("#restoreModal");
			restoreModal.find('input[name=id]').val(link.dataset.id);
			restoreModal.modal();
		});
	});

	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_customer.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   

	$(document).on('click', '.view_sales', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_customer_sales.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   
 });  

	$(document).ready(function(){
		$('#customer_table').dataTable();
	});
