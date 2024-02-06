console.log($().jquery);
$(document).ready(function(){	
	$('#data').jstree({
		"plugins": [
			"checkbox",
			"unique"
		],
		"core":{
			"animation" : 0,
			"check_callback" : true,
			"themes" : { "stripes" : true }
		},
		"root" : {
			"icon" : "../assets/tree-icon-png-17.png",
			"valid_children" : ["default"]
		  }
	
	});

	$('#data').on("changed.jstree", function(e, data){
		if (data.selected.length){

			onMenuItemClick("0", "e", data.node.text);
			$(data.selected).each(function(idx){
				var node = data.instance.get_node(data.selected[idx]);
				//console.log('The node is: ' + node.text);
			});
		}
	});
	$(document).on('dblclick', '.jstree-anchor', function(e) {
		var anchorId = $(this).parent().attr('id');
		var anchorValue = $(this).parent().text();
		var clickId = anchorId.substring(anchorId.indexOf('_') + 1, anchorId.length);
		onMenuItemClick(clickId, e, anchorValue);
	});

	function onMenuItemClick(clickId, e, link) {
		var html_content;
		const Http = new XMLHttpRequest();
		if(link.indexOf(" ")>0){
		const n = link.indexOf(" ");
		link = link.substring(0, n);
		}

const url=`http://localhost/?processlink=$${link}$finishprocesslink`;
Http.open("GET", url);
Http.send();
var control_const = 1;
Http.onreadystatechange = (e) => {
  console.log(Http.responseText)

  document.getElementById("nextlevelplay").src = `http://localhost/?processlink=$${link}$finishprocesslink`;

	
		  
}
	
	
	
	}
	
	
});