$(document).ready(function(e) {
   var sectionId = $(".errorSection").attr("id");
   $("#"+sectionId).css("display","none");
   
   $(".validatedSubmit").click(function(e) {
   	   
	   var arrayErrors = [];
	   var valuesArray = [];
	   
   		$(".validatedInput").each(function(index, element) {
			var value = $(this).val();
			$(this).css("border","1px solid #e6e6e6");
			if(value == ""){
				e.preventDefault();
				//$(".validateForm").removeAttr("action");
				$(this).css("border","1px solid red");
				$("#"+sectionId+" p").text("Please fill all required fields");
				$("#"+sectionId).fadeIn(200);
				arrayErrors.push("error");
			}
        });

		if (arrayErrors.length == 0){
			var id = $(this).attr("id");
			
			if(id == "submitUser"){
				e.preventDefault();
				$(".validateForm").removeAttr("action");
				
				var name = $("#name").val();
				var lastname = $("#lastname").val();
				var email = $("#email").val();
				var username = $("#username").val();
				var password = $("#password").val();
				var confpassword = $("#confpassword").val();
				var privilege = $("#privilege option:selected").attr("data-id");
				var userId = $("#userId").val();
				if(password == confpassword){
					if(password.length < 6){
						$("#password").css("border","1px solid red");
						$("#confpassword").css("border","1px solid red");
						$("#"+sectionId+" p").text("Password length must be at least 6 characters");
						$("#"+sectionId).fadeIn(200);
						return false;
					}else{
								
						function checkUsername(e){
							
							if(e == "true"){
								addUser(name,lastname,email,username,password,privilege);
							}else{
								$("#username").css("border","1px solid red");
								$("#"+sectionId+" p").text("Username already exists");
								$("#"+sectionId).fadeIn(200);
								return false;
							}
							
						}
						if(userId !== undefined){
							updateUser(name,lastname,email,username,password,privilege,userId);
						}else{
							$.ajax({
								type:"POST",
								data:{username:username},
								url:"control/checkUsername.php",
								success:function(e){
									checkUsername(e);
								},
								error: function(error){
									alert(error);
								}
							});		
						}
										
					}
					
				}else{
					$("#password").css("border","1px solid red");
					$("#confpassword").css("border","1px solid red");
					$("#"+sectionId+" p").text("Password and confirm password doesn't match");
					$("#"+sectionId).fadeIn(200);
					return false;
				}
				
			}else{
				return true;	
			}
		}		
   });
   
});
	
	function addUser(name,lastname,email,username,password,privilege){
		$.ajax({
			type:"POST",
			data:{name:name,lastname:lastname,email:email,username:username,password:password, 			   						  	        privilege : privilege},
			url:"control/createUser.php",
			success: function(success){
				console.log(success);
				if(success == "true"){
					window.location = "users.php?users=1";
				}else{
					alert("Problem while adding user please try again");
				}
			},
			error: function(error){
				alert(error);
			}
		});   
	}
	
	function updateUser(name,lastname,email,username,password,privilege,userId){
		$.ajax({
			type:"POST",
			data:{name:name,lastname:lastname,email:email,username:username,password:password, 			   						  	        privilege : privilege,userId:userId},
			url:"control/createUser.php",
			success: function(success){
				console.log(success);
				if(success == "true"){
					window.location = "users.php?users=1";
				}else{
					alert("Problem while adding user please try again");
				}
			},
			error: function(error){
				alert(error);
			}
		});   
	}
	
	