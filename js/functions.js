$(window).load(function() {
	$("#loading").fadeOut(300);
})
$(document).ready(function(e) {
	// make hover current link
		var titleId = $("title").attr("id");
		$("."+titleId).attr("id","activeNav");
		   
	   var isHidden = true;
       $(".linksHead").click(function(e) {
		   e.preventDefault();
        	
			if (isHidden){
				$("#usersProfile").show(200);
				isHidden = false;
			}else{
				$("#usersProfile").hide(200);
				isHidden = true;
			}
    	});
		

		// close usersProfile if u click anywhere in document
		$(document).click(function(e) {
        	if($(e.target).closest('.linksHead').length === 0) {
				if($(e.target).closest('#usersProfile').length === 0){
					$("#usersProfile").hide(200);
					isHidden = true;
				}
  			}   
        });
	
	// Hide rows with filter
	var rowsLength = $("[data-rownr]").length;
	var rowGroupNr = rowsLength / 20 +1;
	for(var i = 1; i<= rowGroupNr; i++){
		$("#rowGroup").append("<option value='"+i+"'>"+i+"</option>");
	}
	var numberOfRows = 20;
	hideRows(numberOfRows,1);
		
	$("#showNrOfRows").change(function(e) {
       numberOfRows = $(this).val();
	   $("#rowGroup").html("");
	    var rowGroupNr = rowsLength / numberOfRows +1;
		for(var i = 1; i<= rowGroupNr; i++){
			$("#rowGroup").append("<option value='"+i+"'>"+i+"</option>");
		}
		hideRows(numberOfRows,1);
    });
	
	$("#rowGroup").change(function(e) {
		 var groupLength = $(this).length;
		 var thisVal = $(this).val();
		 var maxLimit = thisVal * numberOfRows;
		 var minLimit = maxLimit - (numberOfRows-1);
		 hideRows(numberOfRows,minLimit);
    });
	
	
	// UNDER NAVIGATION
	
	$("nav ul li a").each(function(index, element) {
		var activeid = $(this).attr('id');
		$("#"+activeid).parent(this).children().css("display","block");
    });
	
	// TABLE FULLSCREEN, EXIT FULLSCREEN, EXIT TABLE, MINIMIZE
		// FULLSCREEN
	$("#fullscreenBtn").click(function(e) {
		var tableParentId = $(this).parents(".tableDiv").attr("id");
		$("#"+tableParentId).toggleClass("fullscreen");
    });	
	// CLOSE TABLE
	$("#closeTableBtn").click(function(e) {
        var tableParentId = $(this).parents(".tableDiv").attr("id");
		$("#"+tableParentId).css("display","none");
    });
	// MINIMIZE TABLE
	$("#minimizeTableBtn").click(function(e) {
        var tableParentId = $(this).parents(".tableDiv").attr("id");
		$("#tableStyle1 tbody").slideToggle(1000);
    });
	
	// ADD TABLE ---- CHANGE THROW THE PROPERTIE LINKS
	$("#addPageContainer #addTable thead tr th a").click(function(e) {
		//get wich link is clecked
        var linkId = $(this).attr("id");
		// set active to clicked link
		$("#addTable thead tr th a").removeClass("activeLinkInAdd");
		$("#"+linkId).addClass("activeLinkInAdd");
		// make visible the tbody that is wanted
		$("#addTable tbody:not(.linkId)").css("display","none");
		$("."+linkId).css("display","table-header-group");
		$("#addBtn").css("display","table-header-group");
    });
		
	// hide and show under divs
	$(".addPageToMenuContainer h3").click(function(e) {
		$(".addPageToMenuContainer h3").removeClass("activeH3");
    	$(".addPageToMenuContainer div").slideUp(300); 
		$(this).parent("div").children("div").slideDown(300);
		$(this).attr("class","activeH3");
    });
	// CHANGE LAYOUT IMG WHEN A LAYOUT IS SET IN ADD PAGE DROPDOWN
	$("#layout").on("change",function(){
		var layouturl = $("#layout option:selected").attr('data-layoutimgurl');
		$("#infoAddUsers img").attr("src",layouturl);
		$("#infoAddUsers img").fadeIn(500);
	});
	// arrange pages and links in menu
	$("#menuLinks ul li").each(function(index, element) {
		var count = index+1;
        $(this).attr("id","menu-item"+count);
    });
	
	$(".up").click(function(e) {
		e.preventDefault();
		// get clicked li parent
		var parentLiId = $(this).parents("li").attr("id");
		// get clicked div parent
		var thisDiv = $("#"+parentLiId+" div").attr("id");
		var thisDivText = $("#"+parentLiId+" div #nameContainer").text();
		var thisDivTextBlockquote = $("#"+parentLiId+" div blockquote").text();
		// get positions and texts
		var position = parseInt(parentLiId.replace("menu-item", "")); 
		if(position != 1){
			var positionToChange = position-1;
			var divlToChange = $("#menu-item"+positionToChange+" div").attr("id");
			var divlToChangeText =  $("#menu-item"+positionToChange+" div #nameContainer").text();
			var divlToChangeTextBlockquote =  $("#menu-item"+positionToChange+" div blockquote").text();
			//change positions and texts		
			$("#menu-item"+positionToChange+" div").attr("id",thisDiv);
			$("#menu-item"+position+" div").attr("id",divlToChange);
			
			$("#menu-item"+positionToChange+" div #nameContainer").text(thisDivText);
			$("#menu-item"+position+" div #nameContainer").text(divlToChangeText);	
			$("#menu-item"+positionToChange+" div blockquote").text(thisDivTextBlockquote);
			$("#menu-item"+position+" div blockquote").text(divlToChangeTextBlockquote);
		}
    });
	
	$(".down").click(function(e) {
		e.preventDefault();
		// get clicked li parent
		var parentLiId = $(this).parents("li").attr("id");
		// get clicked div parent
		var thisDiv = $("#"+parentLiId+" div").attr("id");
		var thisDivText = $("#"+parentLiId+" div #nameContainer").text();
		var thisDivTextBlockquote = $("#"+parentLiId+" div blockquote").text();
		// get positions and texts
		var position = parseInt(parentLiId.replace("menu-item", "")); 
		var lengthOfLi = $("#menuLinks ul li").length;
		lengthOfLi = lengthOfLi;
		if(position != lengthOfLi){
			var positionToChange = position+1;
			var divlToChange = $("#menu-item"+positionToChange+" div").attr("id");
			var divlToChangeText =  $("#menu-item"+positionToChange+" div #nameContainer").text();
			var divlToChangeTextBlockquote =  $("#menu-item"+positionToChange+" div blockquote").text();
			//change positions and texts		
			$("#menu-item"+positionToChange+" div").attr("id",thisDiv);
			$("#menu-item"+position+" div").attr("id",divlToChange);
			
			$("#menu-item"+positionToChange+" div #nameContainer").text(thisDivText);
			$("#menu-item"+position+" div #nameContainer").text(divlToChangeText);	
			$("#menu-item"+positionToChange+" div blockquote").text(thisDivTextBlockquote);
			$("#menu-item"+position+" div blockquote").text(divlToChangeTextBlockquote);	
		}
    });
	// drag and drop
	var isOk;
	var id;
	$("#menuLinks ul li div").mousedown(function(e){
		$("#removeLinkContainer").css("display","block");
		isOk = true;
		$(this).css("position","absolute");
		$(this).css("z-index","2");
		id = $(this).attr("id");
		// find the mouse top cordinates within a div
		var yDiv = $("#"+id).offset().top;
		var yM = e.clientY;
		var topInDiv = yM-yDiv;
		// find the mouse left cordinates within a div
		var xDiv = $("#"+id).offset().left;
		var xM = e.clientX;
		var leftInDiv = xM-xDiv;
		$(document).on('mousemove',function(eve) {
			if(isOk === true){
				$("#"+id).offset({ top: eve.clientY-topInDiv, left: eve.clientX-leftInDiv });
				var removeTop = $("#removeLinkContainer").offset().top;
				var mouseTop = $("#"+id).offset().top;

				if(mouseTop >= removeTop){
					$("#removeLinkContainer").css("background-color","rgba(255,0,0,0.5)");					
				}else{
					$("#removeLinkContainer").css("background","rgba(204,204,204,0.5)");						
				}
			}
		});	
		
	}).mouseup(function(e){
		
		var removeTop = $("#removeLinkContainer").offset().top;
		var mouseTop = $(this).offset().top;
		$("#removeLinkContainer h3").text(mouseTop);
		if(mouseTop >= removeTop){
			$(this).parents("li").css("display","none");
			$(this).parents("li").attr("id","deleted");				
		}
		$(this).css("position","relative");
		$(this).css("z-index","");
		$(this).css("top","");
		$(this).css("left","");
		
		$("#removeLinkContainer").css("display","none");
		isOk = false;
		var count = 1;
		$("#menuLinks ul li").each(function(index, element) {
       		var isDel = $(this).attr("id");
			if(isDel !== "deleted"){
				$(this).attr("id","menu-item"+count);	
				count++;
			}
	    });
	});
	
	// change navigation to edit 
	$("#menuChange").change(function(e) {
		var menuId = $("#menuChange option:selected").val();
    	window.location = "pages.php?pages=4&menu="+menuId;
    });
	
	// ADD PAGES, CATEGORY OR CUSTOM LINK TO MENU
	$("#addToMenuBtn").click(function(e) {
		var pageIds = [];
		// make a array with pages to add
		var count = 0;
		$(".pages:checked").each(function(index, element) {
            pageIds[count] = $(this).val();
			count++;
        });
		// make a array with categories to add
		var catIds = [];
		var count = 0;
		$(".category:checked").each(function(index, element) {
            catIds[count] = $(this).val();
			count++;
        });
		// get custom link
		var customLink = $("#customLinkName").val();
		var charrsLength = customLink.length;
		
		// get menu ID and appearName for link
		var menuId = $("#menuChange option:selected").val();
		var appearName = $("#appearName").val();
		
		addPagesToMenu(menuId,pageIds,appearName);
		addCategoryToMenu(menuId,catIds,appearName);
		if(customLink != "" && charrsLength >= 10){
			addCustomLinkToMenu(menuId,customLink,appearName);	
		}
    });
	// SAVE CHANGES TO MENU
	$(".saveMenu").click(function(e) {
        var menuTitle = $("#menuTitle").val();
		var linksArray = [];
		var positionArray = [];
		var deletedList = [];
		var count = 0;
		$("#menuLinks ul li").each(function(index, element) {
			var liId = $(this).attr("id");	
			var linkId = $(this).children("div").attr("id");
			if(liId == "deleted"){
				deletedList.push(linkId);	
			}else{
				var position = liId.replace("menu-item", "");
				positionArray.push(position);
				linksArray.push(linkId);			
			}
			count++;
		});
		var isMain = $("#isMain").prop("checked");
		var menuId = $("#menuId").val();
		editMenu(menuId,menuTitle,isMain,linksArray,positionArray,deletedList);
    });
	// ADD MENU
	$("#createMenu").click(function(e) {
        $("#createMenuWrapper").show(500);
		$("#language").removeAttr("disabled");
    });
	$("#cancelAddMenu").click(function(e) {
		$("#createMenuWrapper").hide(500);
		$("#createMenuWrapper input:not(#addMenuBtn)").val("");
    });
	$(".makeUnder").click(function(e) {
        var linkIdFosub = $(this).attr("id");
		$("#createMenuWrapper").show(500);
		$("#parentForSub").val(linkIdFosub);
		$("#language").attr("disabled","disabled");
    });
	
	// add image in posts
	var countFiles = 1;
	$("#addImage").click(function(e) {
        $("#mediaHolder").append("<input type=\"file\" name='mediaUploads[]' class='upf' id='file"+countFiles+"'>");
		$("#file"+countFiles).click();
		
		countFiles++;
		$(".upf").change(function(e) {
			e.stopPropagation(); // Stop stuff happening
		    e.preventDefault(); // Totally stop stuff happening
			
			var uploadFileVal = $(this).val();
			var uploadFileId = $(this).attr("id");
			var files = e.target.files;
			var data = new FormData();
			$.each(files, function(key, value){
		        data.append(key, value);
			});
		 	console.log(files);
		   	addTmpFiles(data,uploadFileVal,uploadFileId);
        });
    });
	// add youtube videos
	var countYoutubeVideos = 1;
	$("#addYoutube").click(function(e){
		$("#mediaBtnTr").after("<tr class='youtubeTr' id='trYoutube"+countYoutubeVideos+"'><td>Youtube videos:</td><td><input type='text' name='youtube[]'><input type='submit' name='youtubeSubmit' value='Upload' id='you"+countYoutubeVideos+"' class='youtubeSubmit'></td></tr>");
	countYoutubeVideos++;
	});
	
	// WHEN YOUTUBE UPLOAD BTN IS CLICKED
	$(document).on('click', '.youtubeSubmit', function(e){
		e.preventDefault();
		var youVideoLink = $(this).parent("td").children("input[type='text']").val();
		var submitId = $(this).parent().parent().attr("id");
		$("#imagesPreiviev").append("<div data-uploadFileId='"+submitId+"' class='tmpParentDiv'><span><a href='#' class='removeTmpImg'><img src='images/x.png'></a></span><iframe width='100%' height='215' src='https://www.youtube.com/embed/"+youVideoLink+"'></iframe></div>");			
		$(this).parent().parent().css("display","none");
	});
	
	// REMOVE MEDIA FROM TMP WHEN CLOSE IS CLICKED
	$(document).on('click', '.removeTmpImg', function() {
		var idToBeRemoved = $(this).parents("div").attr("data-uploadFileId");		
		$(this).parent().parent().remove();
		$("#"+idToBeRemoved).remove();
	});
	// DELETE MEDIA WHILE EDITING POST
	$(".removeImg").click(function(e) {
		var mediaId = $(this).attr("data-mediaId");
		var divToBeRemoved = $(this).parent().parent().attr("id");
        deleteMedia(mediaId,divToBeRemoved);
    });
	// DELETE MEDIA WHILE EDITING HOTEL
	$(".removeHotelImg").click(function(e) {
		var mediaId = $(this).attr("data-mediaId");
		var divToBeRemoved = $(this).parent().parent().attr("id");
        deleteMediaForHotel(mediaId,divToBeRemoved);
    });	
	
	// ADD CATEGORY
	$("#addCatButton").click(function(e) {
		e.preventDefault();
		var categoryName = $("#addCatInput").val();
		var parent = $("#addCategorySelect option:selected").val();
		addCategories(categoryName,parent);      
    });
	// DELETE CATEGORY
	$("#deleteCategoryBtn").click(function(e) {
		e.preventDefault();
		var categoryIds = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var catId = $(this).attr("id");
			categoryIds.push(catId);
        });
		deleteCategories(categoryIds);
    });
	// ADD LANGUAGE
	$("#addLangButton").click(function(e) {
		e.preventDefault();
		var langName = $("#addLangInput").val();
		addLanguages(langName);      
    });
	// DELETE CATEGORY
	$("#deleteLanguageBtn").click(function(e) {
		e.preventDefault();
		var languageIds = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var langId = $(this).attr("id");
			languageIds.push(langId);
        });
		deleteLanguages(languageIds);
    });
	// ADD WIDGETS
	$("#addWidgetButton").click(function(e) {
		e.preventDefault();
		var widgetName = $("#addWidgetInput").val();
		addWidget(widgetName);      
    });
	// DELETE WIDGET
	$("#deleteWidgetBtn").click(function(e) {
		e.preventDefault();
		var widgetIds = [];
		$(".checkForDelete:checked").each(function(index, element) {
            var widgetId = $(this).attr("id");
			widgetIds.push(widgetId);
        });
		deleteWidget(widgetIds);
    });
	// change widget content type
	$(".widgetContentType").on("change",function(e){
		var typeId = $(this).attr("id");
		var type = $("#"+typeId+" option:selected").attr("data-type");
		var menuOrPostId = $("#"+typeId+" option:selected").attr("data-id");
		var widgetId = typeId.replace("widgetContentType","");
		changeContentType(widgetId,type,menuOrPostId);
	});
	
	/* FILTER POST BY PAGE */
	$("#pagesPerPost").change(function(){
		var pageName = $(this).val();	
		$(".allPostsTable tbody tr").css("display","none");
		$(".allPostsTable tbody tr").each(function(index, element) {
			var id = $(this).attr("id");
			var pageNameOfTr = $(this).attr("data-pagename");
            if(pageNameOfTr == pageName || pageName == "all"){
				$("#"+id).css("display","table-row");
			}
        });
	});
	
	// Change user privilege
	$(".changePriDropDown").change(function(e) {
  	    var val = $(".changePriDropDown option:selected").val();
		var userId = $(this).children().attr("data-code");
		changePriDropDown(val,userId);
		
    });
});
function hideRows(numberOfRows,minLimit){
	$("[data-rownr]").css("display","table-row");
	numberOfRows = parseInt(numberOfRows);
	minLimit = parseInt(minLimit);
	var	maxLimit = parseInt((numberOfRows-1)+minLimit);

	$("[data-rownr]").each(function(index, element) {
		var thisRow = parseInt($(this).attr("data-rownr"));
		
		if(minLimit > thisRow || maxLimit < thisRow){
			$(this).css("display","none");
		}
    });	
}

function addPagesToMenu(menuId,pageId,appearName){
	$.ajax({
		type:"POST",
		data:{menuId:menuId,pageId:pageId,appearName:appearName,isCategory:"false"},
		url:"control/addToMenu.php",
		success:function(e){
			if(e == "true"){
				location.reload();	
			}else{
				//alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}

function addCategoryToMenu(menuId,catIds,appearName){
	$.ajax({
		type:"POST",
		data:{menuId:menuId,catIds:catIds,appearName:appearName,isCategory:"true"},
		url:"control/addToMenu.php",
		success:function(e){
			if(e == "true"){
				location.reload();	
			}else{
				//alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function addCustomLinkToMenu(menuId,customLink,appearName){
	$.ajax({
		type:"POST",
		data:{menuId:menuId,customLink:customLink,appearName:appearName,isCategory:"false",isCustomLink:"true"},
		url:"control/addToMenu.php",
		success:function(e){
			if(e == "true"){
				location.reload();	
			}else{
				//alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}

function editMenu(menuId,menuTitle,isMain,linksArray,positionArray,deletedList){
	$.ajax({
		type:"POST",
		data:{menuId:menuId,menuTitle:menuTitle,isMain:isMain,linksArray:linksArray,positionArray:positionArray,deletedList:deletedList},
		url:"control/editMenu.php",
		success:function(e){
			alert(e);
			if(e == "true"){
				location.reload();	
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}

function addTmpFiles(data,uploadFileVal,uploadFileId){
	$.ajax({
        url: 'control/uploadTmpFiles.php',
        type: 'POST',
        data: data,
        cache: false,
        //dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(e)
		
        {
			console.log(e);
			var path = e.replace("../","");
			$("#imagesPreiviev").append("<div data-uploadFileId='"+uploadFileId+"' class='tmpParentDiv'><span><a href='#' class='removeTmpImg'><img src='images/x.png'></a></span><a href='"+path+uploadFileVal+"' target='_blank'><img src='"+path+uploadFileVal+"'></a></div>");
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });	
}
function deleteMedia(mediaId,divToBeRemoved){
	$.ajax({
		type:"POST",
		data:{mediaId:mediaId},
		url:"control/deleteMedia.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				$("#"+divToBeRemoved).remove();
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function deleteMediaForHotel(mediaIdForHotel,divToBeRemoved){
	$.ajax({
		type:"POST",
		data:{mediaIdForHotel:mediaIdForHotel},
		url:"control/deleteMedia.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				$("#"+divToBeRemoved).remove();
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function addCategories(categoryName,parent){
	$.ajax({
		type:"POST",
		data:{categoryName:categoryName,parent:parent},
		url:"control/addAndDeleteCategory.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function deleteCategories(categoryId){
	$.ajax({
		type:"POST",
		data:{categoryId:categoryId},
		url:"control/addAndDeleteCategory.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}

function addLanguages(langName){
	$.ajax({
		type:"POST",
		data:{langName:langName},
		url:"control/addAndDeleteLanguage.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function deleteLanguages(languageIds){
	$.ajax({
		type:"POST",
		data:{languageIds:languageIds},
		url:"control/addAndDeleteLanguage.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function addWidget(widgetName){
	$.ajax({
		type:"POST",
		data:{widgetName:widgetName},
		url:"control/addAndDeleteWidget.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function deleteWidget(widgetIds){
	$.ajax({
		type:"POST",
		data:{widgetIds:widgetIds},
		url:"control/addAndDeleteWidget.php",
		success:function(e){
			console.log(e);
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}
function changeContentType(widgetId,type,menuOrPostId){
	var array = [];
	$.ajax({
		type:"POST",
		data:{widgetId:widgetId,type:type,menuOrPostId:menuOrPostId},
		url:"control/addAndDeleteWidget.php",
		success:function(e){
			if(e == "true"){
				location.reload();				
			}else{
				alert(e);
			}
		},
		error: function(xhr, status, thrown){
			alert(thrown);
		}
	});		
}

function changePriDropDown(privilege,userId){
	$.ajax({
		type:"POST",
		data:{privilege:privilege,userId:userId},
		url:"control/changeUserPrivilege.php",
		success:function(e){
			if(e == "true"){
				location.reload();	
			}else{
				//alert(e);
			}
		},
		error: function(error){
			alert(error);
		}
	});		
}