$(document).ready(function(e) {
	
	// DELETE USER 
	$("#deleteUserButton").click(function(e) {
		e.preventDefault();
		var userList = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var id = $(this).attr("id");
			userList.push(id);
        });
		
		if(userList.length != 0){
			 deleteUser(userList);
		}else{
			alert("Select a user to delete");	
		}
    });
	
	// DELETE PAGE
	$("#deletePage").click(function(e) {
		e.preventDefault();
		var pageList = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var id = $(this).attr("id");
			pageList.push(id);
        });
		
		if(pageList.length != 0){
			 deletePage(pageList);
		}else{
			alert("Select a page to delete");	
		}
    });
	// DELETE PAGE LAYOUT
	$("#deletePageLayout").click(function(e) {
		e.preventDefault();
		var pageLayoutList = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var id = $(this).attr("id");
			pageLayoutList.push(id);
        });
		console.log(pageLayoutList);
		if(pageLayoutList.length != 0){
			 deletePageLayout(pageLayoutList);
		}else{
			alert("Select a page layout to delete");	
		}
    });
	// DELETE POST
	$("#deletePost").click(function(e) {
		e.preventDefault();
		var postList = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var id = $(this).attr("id");
			postList.push(id);
        });
		console.log(postList);
		if(postList.length != 0){
			 deletePost(postList);
		}else{
			alert("Select a post to delete");	
		}
    });
	// DELETE HOTEL
	$("#deleteHotel").click(function(e) {
		e.preventDefault();
		var hotelList = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var id = $(this).attr("id");
			hotelList.push(id);
        });
		console.log(hotelList);
		if(hotelList.length != 0){
			 deleteHotel(hotelList);
		}else{
			alert("Select a hotel to delete");	
		}
    });
	
});

function deleteUser(userList){
	$.ajax({
		type:"POST",
		data:{userList : userList},
		url:"control/deleteUser.php",
		success: function(e){
			if(e == "true"){
				alert("Deletion succeed");	
				window.location = "users.php?users=1";
			}else{
				alert("Deletion failed");
			}
		},
		error: function(e){
			alert(e);
		}	
	});	
}
function deletePage(pageList){
	$.ajax({
		type:"POST",
		data:{pageList : pageList},
		url:"control/deletePage.php",
		success: function(e){
			if(e == "true"){
				alert("Deletion succeed");	
				window.location = "pages.php?pages=1";
			}else{
				alert("Deletion failed");
			}
		},
		error: function(e){
			alert(e);
		}	
	});	
}

function deletePageLayout(pageLayoutList){
	$.ajax({
		type:"POST",
		data:{pageLayoutList : pageLayoutList},
		url:"control/deletePageLayout.php",
		success: function(e){
			if(e == "true"){
				alert("Deletion succeed");	
				window.location = "pages.php?pages=3";
			}else{
				alert("Deletion failed");
			}
		},
		error: function(e){
			alert(e);
		}	
	});	
}
function deletePost(postList){
	$.ajax({
		type:"POST",
		data:{postList : postList},
		url:"control/deletePost.php",
		success: function(e){
			if(e == "true"){
				alert("Deletion succeed");	
				window.location = "posts.php?posts=1";
			}else{
				alert("Deletion failed");
			}
		},
		error: function(e){
			alert(e);
		}	
	});	
}
function deleteHotel(hotelList){
	$.ajax({
		type:"POST",
		data:{hotelList : hotelList},
		url:"control/deleteHotel.php",
		success: function(e){
			if(e == "true"){
				alert("Deletion succeed");	
				window.location = "booking.php?booking=1";
			}else{
				alert("Deletion failed");
			}
		},
		error: function(e){
			alert(e);
		}	
	});	
}