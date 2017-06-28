/*
 filedrag.js - HTML5 File Drag & Drop demonstration
 Featured on SitePoint.com
 Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
 */
var incidentImageArray = [];
var galleryFileUploadRemainingCount = 0;
(function() {

	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}


	// output information
	function Output(msg) {
		var m = $id("messages");
		m.innerHTML = msg + m.innerHTML;
	}


	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// file selection
	function FileSelectHandler(e) {

		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;

		// process all File objects
		var domElements = [
			document.createElement('li'),
			document.createElement('a'),
			document.createElement('img')
		];
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f);
		}

	}

	// output file information
	function ParseFile(file) {

		var fileSize = file.size/1024;
		var validateFileSize = fileSize / 1024;
		fileSize = fileSize.toFixed(2);
		if(galleryFileUploadRemainingCount<5){
			if(validateFileSize <= 1){
				if(file.type == "image/png" || file.type == "image/jpeg"){

					incidentImageArray.push(file);
					galleryFileUploadRemainingCount++;

					var preview = document.createElement("img");
					var div = document.createElement("div");
					var p = document.createElement("p");
					var p1 = document.createElement("p");
					var reader = new FileReader();
					reader.addEventListener("load", function(){
						preview.src = reader.result;
						preview.setAttribute("width", "100px");
						preview.setAttribute("height", "100px");

						var textNode1 = document.createTextNode("x");
						p1.appendChild(textNode1);
						p1.setAttribute("style", "margin-top: -120px; z-index : 1; position : absolute; float:right; width:20px; height:20px; border-radius : 10px; border:1px solid red; background-color: red; color:#FFF	");
						p1.setAttribute("onclick", "deleteImg('"+(galleryFileUploadRemainingCount)+"')");


						var textNode = document.createTextNode(fileSize + "KB");
						p.appendChild(textNode);
						p.setAttribute("class", "text-center")
						div.setAttribute("class", "col-sm-3 col-xs-6 text-center");
						div.setAttribute("id", (galleryFileUploadRemainingCount));
						//preview.setAttribute("class", "thumbnail  text-center");
						div.appendChild(preview);
						div.appendChild(p);
						div.appendChild(p1);
						document.getElementById("test").appendChild(div);
					});
					if(file){
						reader.readAsDataURL(file);
					}
					//Output(
					//	"<p><img src='"+file+"' alt=''/>File information: <strong>" + file.name +
					//	"</strong> type: <strong>" + file.type +
					//	"</strong> size: <strong>" + file.size +
					//	"</strong> bytes</p>"
					//);

				} else {
					document.getElementById("uploadImageStatus").innerHTML = "Please select valid image files in the format of png or jpeg!";
				}
			} else {
				document.getElementById("uploadImageStatus").innerHTML = "Please select file size below to 1 MB";
			}
		} else {
			document.getElementById("uploadImageStatus").innerHTML = "You reached file upload limit 5";
		}
	}


	// initialize
	function Init() {

		var fileselect = $id("fileselect"),
			filedrag = $id("filedrag");
			//submitbutton = $id("submitbutton");

		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			// file drop
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";

			// remove submit button
			//submitbutton.style.display = "none";
		}

	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}


})();