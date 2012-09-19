$(document).ready(function(){
	
	$("#circles a").click(function(){

		var largePath = $(this).attr("href");
	
		$("#body #slider img").attr({ src: largePath });
		
		return false;
		});
	

	});