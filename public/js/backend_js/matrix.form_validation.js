
$(document).ready(function(){

	$('#current_pwd').keyup(function(){
		var current_pwd = $('#current_pwd').val();
		//alert(current_pwd);
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				// alert("true");
				if(resp == "false"){
					$("#chkPass").html("<font color='red'>Current Password is Incorrect</font>");
				}else if(resp == "true"){
					$("#chkPass").html("<font color='green'>Current Password is Correct</font>");
				}
			},
			error: function(){
				alert('Error');
			}
		});
	});
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Add category Validation
    $("#add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Add product Validation
    $("#add_product").validate({
		rules:{
			category_id:{
				required:true,
				number:true,
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			description:{
				required:true,
			},
			price:{
				required:true,
				number:true,
			},
			image:{
				required:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Edit product Validation
    $("#edit_product").validate({
		rules:{
			category_id:{
				required:true,
				number:true,
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			description:{
				required:true,
			},
			price:{
				required:true,
				number:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// edit category Validation
    $("#edit_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:4,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:4,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:4,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$(".delcat").click(function(){
		if(confirm('Are you sure you want to delete this category ?')){
			return true;
		}else{
			return false;
		}
	}); 
});
