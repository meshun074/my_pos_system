function loadproducts(){
    var name = $("#search").val();
    if(name){
        $.ajax({
            type: 'post',
            data: {
                products:name,
            },
            url: 'loadproducts.php',
            success: function (Response){
                $('#products').html(Response);
            }
        });
    }
};

$(document).ready(function(){

    $('#customer_search').typeahead({

        source: function(query, result)
        {

            $.ajax({
                url: 'loadcustomer.php',
                method: "POST",
                data:{
                    query:query
                },
                dataType: "json",
                success:function(data)
                {
                    result($.map(data,function(item){
                        return item;
                    }));
                }
            })
        }
    });
});


function GrandTotal(){
    var TotalValue = 0;
    var TotalPriceArr = $('#tableData tr .totalPrice').get()
    var discount = $('#discount').val();

    $(TotalPriceArr).each(function(){
        TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("₵",""));
    });

    if(discount != null){
        var f_discount = 0;

        f_discount = TotalValue - discount;

        $("#totalValue").text(accounting.formatMoney(f_discount,{symbol:"₵",format: "%s %v"}));
        $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
    }else{
        $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"₵",format: "%s %v"}));
        $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
    }
};

$(document).on('change', '#discount', function(){
    GrandTotal();
});

$('body').on('click','.js-add',function(){
    var totalPrice = 0;
    var target = $(this);
    var product_id = target.attr('data-id');
    var product = target.attr('data-product');
    var price = target.attr('data-price');
    var cprice = target.attr('data-cprice');
    var barcode = target.attr('data-barcode');
    var size = target.attr('data-unt');
    swal({
        title: "Enter number of items:",
        content: "input",
    })
        .then((value) => {
            if (value == "") {
                swal("Error","Entered none!","error");
            }else{
                var qtynum = value;
                if (isNaN(qtynum)){
                    swal("Error","Please enter a valid number!","error");
                }else if(qtynum == null){
                    swal("Error","Please enter a number!","error");
                }else{
                    var total = parseInt(value,10) * parseFloat(price);
                    $('#tableData').append("<tr class='prd'><td> "+barcode+" <input type='text' hidden class='barcode text-center' value='"+product_id+"'></td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"₵",format: "%s %v"})+"</td><td hidden class='cprice text-center'>"+accounting.formatMoney(cprice,{symbol:"₵",format: "%s %v"})+"</td><td class='text-center'>"+size+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"₵",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
                    GrandTotal();
                }
            }
        });
});

$(document).ready(function(){
    document.getElementById("search").focus();
});

$("body").on('click','#delete-row', function(){
    var target = $(this);
    swal({
        title: "Remove this item?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $(this).parents("tr").remove();
                swal("Removed Successfully!", {
                    icon: "success",
                });
                GrandTotal();
            }
        });
});

$(document).on('click','#check', function(){
    var checkbox = $('input[type=checkbox]').prop('checked');

    if(checkbox){
        $("#customer_search").prop('required',true);
    }else {
        $("#customer_search").prop('required',false);
    }

})

function printSection(el) {
    var getFullContent = document.body.innerHTML;
    var printScreen = document.getElementById(el).innerHTML;
    document.body.innerHTML = printScreen;
    window.print();
    document.body.innerHTML = getFullContent;
}

$(document).on('click','#print_reciept', function(){
    printSection('reciept');
    window.location.href='main.php';
})

$(document).on('click','#submit_customer',function(){
    // alert("hello");
    var cus_create = new FormData();
    var user = $('#user1').val();
    var fname = $('#fname1').val();
    var lname = $('#lname1').val();
    var address= $('#address1').val();
    var number = $('#number1').val();
    var image = $('#image1')[0].files; 

    if($.trim($('#fname1').val()).length == 0){
        swal("Warning","Please Enter First Name!","warning");
        return false;
    }
    if($.trim($('#lname1').val()).length == 0){
        swal("Warning","Please Enter Last Name!","warning");
        return false;
    }
    if($.trim($('#address1').val()).length == 0){
        swal("Warning","Please Enter Address!","warning");
        return false;
    }
    if($.trim($('#number1').val()).length == 0){
        swal("Warning","Please Enter Number!","warning");
        return false;
    }
    // if(image.length > 0 ){
    //     fd.append('file',files[0]);
    if($.trim($('#image1').val()).length == 0){
        swal("Warning","Please Choose an Image!","warning");
        return false;
    }
    
    cus_create.append('user',user);
    cus_create.append('fname',fname); 
    cus_create.append('lname',lname);
    cus_create.append('address',address);  
    cus_create.append('number',number);       
    cus_create.append('image',image[0]);  

    $.ajax({
        url: "add_customer.php",
        type: "post",
        data: cus_create,
        contentType: false,
        processData: false,
        success : function(data){
            if(data=="cus_added")                
                // if(isset($_POST['cus_added']))
                {
                    swal("Added Successful","Customer added successfully","success");
                    document.getElementById("modal-form").reset();
                                
            }else{
                swal("Failed","Failed to add customer","error");
            }

        }
        }); 

    // return false;

})

function show_reciept(owes,paid){
    $.ajax({  
        url:"load_reciept_details.php",  
        method:"POST",  
        data:{'load_receipt':'yes','paid':paid,'owes':owes},  
        success:function(data){ 
            $('#reciept').html(data);  
            $('#printModal').modal('show');  
        }  
    }); 

}





function calf(){
    var TotalPriceArr = $('#tableData tr .totalPrice').get();

    // if($.trim($('#customer_search').val()).length == 0){
    //     swal("Warning","Please Enter Customer Name!","warning");
    //     return false;
    // }

    if (TotalPriceArr == 0){
        swal("Warning","No products ordered!","warning");
        return false;
    }else{

        var product = [];
        var quantity = [];
        var price = [];
        var cprice = [];
        var user = $('#uname').val();
        var customer = $('#customer_search').val();
        var discount = $('#discount').val();

        $('.barcode').each(function(){
            product.push($(this).val());
            // alert($(this).val())
        });
        $('.qty').each(function(){
            quantity.push($(this).text());
        });
        $('.price').each(function(){
            price.push($(this).text().replace(/,/g, "").replace("₵",""));
        });
        $('.cprice').each(function(){
            cprice.push($(this).text().replace(/,/g, "").replace("₵",""));
        });

        swal({
            title: "Enter Cash",
            content: "input",
        })
            .then((value) => {
                if(value == "") {
                    swal("Error","Entered None!","error");
                }else{

                    var qtynum = value;
                    if(isNaN(qtynum)){
                        swal("Error","Please enter a valid number!","error");
                    }else if(qtynum == null){
                        swal("Error","Entered None!","error");
                    }else{

                        var change = 0;
                        var owes = 0;
                        var status = "full payment";
                        var depo = $('#depo').val();


                        // var TotalPriceArr = $('#tableData tr .totalPrice').get()
                        // $(TotalPriceArr).each(function(){
                        //   TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("₵",""));
                        // });
                        var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("₵",""));

                        if(TotalValue > qtynum){
                            swal("Error","Can't process a smaller number","error");
                        }else{
                            if($.trim($('#customer_search').val()).length == 0)
                            {
                                change = parseFloat(value,10) - parseFloat(TotalValue);
                                $.ajax({
                                    url:"insert_sales.php",
                                    method:"POST",
                                    data:{totalvalue:TotalValue, product:product, price:price, cprice:cprice, user:user, quantity:quantity, discount:discount, depo:depo, owes:owes, status:status, paid:TotalValue},
                                    success: function(data){                                        

                                        if( data == "success"){
                                            swal({
                                                title: "Change is " + accounting.formatMoney(change,{symbol:"₵",format: "%s %v"}),
                                                icon: "success",
                                                buttons: "Okay",
                                            })
                                                .then((okay)=>{
                                                    if(okay){
                                                        show_reciept(owes.toFixed(2),TotalValue);                                                        
                                                        
                                                    }
                                                })
                                        }else{
                                            window.location.href='main.php?'+data;
                                        }

                                    }
                                });
                            }
                            else
                            {
                                change = parseInt(value,10) - parseFloat(TotalValue);
                                $.ajax({
                                    url:"insert_sales.php",
                                    method:"POST",
                                    data:{totalvalue:TotalValue, product:product, price:price, cprice:cprice, user:user, customer:customer, quantity:quantity, discount:discount, depo:depo, owes:owes.toFixed(2), status:status, paid:TotalValue},
                                    success: function(data){

                                        if( data == "success"){
                                            swal({
                                                title: "Change is " + accounting.formatMoney(change,{symbol:"₵",format: "%s %v"}),
                                                icon: "success",
                                                buttons: "Okay",
                                            })
                                                .then((okay)=>{
                                                    if(okay){
                                                        show_reciept(owes.toFixed(2),TotalValue); 
                                                    }
                                                })
                                        }else{
                                            window.location.href='main.php?'+data;
                                        }

                                    }
                                });
                            }
                        }
                    }
                }
            });
    }
}

function calt() {
    var TotalPriceArr = $('#tableData tr .totalPrice').get();

    if($.trim($('#customer_search').val()).length == 0){
        swal("Warning","Please Enter Customer Name!","warning");
        return false;
    }

    if (TotalPriceArr == 0){
        swal("Warning","No products ordered!","warning");
        return false;
    }else{

        var product = [];
        var quantity = [];
        var price = [];
        var cprice = [];
        var user = $('#uname').val();
        var customer = $('#customer_search').val();
        var discount = $('#discount').val();

        $('.barcode').each(function(){
            product.push($(this).val());
        });
        $('.qty').each(function(){
            quantity.push($(this).text());
        });
        $('.price').each(function(){
            price.push($(this).text().replace(/,/g, "").replace("₵",""));
        });
        $('.cprice').each(function(){
            cprice.push($(this).text().replace(/,/g, "").replace("₵",""));
        });

        swal({
            title: "Enter Cash",
            content: "input",
        })
            .then((value) => {
                if(value == "") {
                    swal("Error","Entered None!","error");
                }else{

                    var qtynum = value;
                    if(isNaN(qtynum)){
                        swal("Error","Please enter a valid number!","error");
                    }else if(qtynum == null){
                        swal("Error","Entered None!","error");
                    }else{

                        var owes = 0;
                        var status = "on credit";
                        var depo = $('#depo').val();

                        // var TotalPriceArr = $('#tableData tr .totalPrice').get()
                        // $(TotalPriceArr).each(function(){
                        //   TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("₵",""));
                        // });
                        var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("₵",""));


                            owes = parseFloat(TotalValue) - parseInt(value,10);
                            $.ajax({
                                url:"insert_sales.php",
                                method:"POST",
                                data:{totalvalue:TotalValue, product:product, price:price, cprice:cprice, user:user, customer:customer, quantity:quantity, discount:discount, depo:depo, owes:owes, status:status, paid:value},
                                success: function(data){

                                    if( data == "success"){
                                        swal({
                                            title: "Owes us " + accounting.formatMoney(owes,{symbol:"₵",format: "%s %v"}),
                                            icon: "success",
                                            buttons: "Okay",
                                        })
                                            .then((okay)=>{
                                                if(okay){
                                                    show_reciept(owes.toFixed(2),value);
                                                }
                                            })
                                    }else{
                                        window.location.href='main.php?'+data;
                                    }

                                }
                            });
                    }
                }
            });
    }
}









$(document).on('click','.Enter',function(){
    var checkbox = $('input[type=checkbox]').prop('checked');

    if(checkbox){
        calt();
    }else {
        calf();
    }

});

$(document).on('click','.cancel',function(e){
    var TotalPriceArr = $('#tableData tr .totalPrice').get();
    if (TotalPriceArr == 0){
        return 0;
    }else{
        swal({
            title: "Cancel orders?",
            text: "By doing this,orders will remove!",
            icon: "warning",
            buttons: ["No","Yes"],
            dangerMode: true,
        })
            .then((reload) => {
                if (reload) {
                    location.reload();
                }
            });
    }
});

function out(){
    var lag = "logout";
    swal({
        title: "Logout?",
        icon: "warning",
        buttons: ["Cancel","Yes"],
        dangerMode: true,
    })
        .then((value) => {
            if(value){
                if(lag){
                    $.ajax({
                        type: 'post',
                        data: {
                            logout:lag
                        },
                        url: 'server/connection.php',
                        success: function (data){
                            window.location.href='index.php';
                        }
                    });
                }
            }
        })
};
