<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 10);
	
		if(!$access && $_SESSION['account_type'] != 'Administrator') {
			echo '<script> window.history.back(); </script>';
		}
	} else {
		echo '<script> window.history.back(); </script>';
	}

	//list of category
	require_once('../dao/dao.categories.php');
	$categories = categories_dao::categories_list(); 

	// rewards detail
	require_once('../dao/dao.rewards.php');
	$id = $_GET['id'];
	$rno = rewards_dao::rewards_view($id); 
	$rno_gallery = rewards_dao::rno_gallery($id); 
	$rno_documents = rewards_dao::rno_documents($id);
	if ($rno_documents == false) {
		$limit = 0;
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Update Article Details</title> 

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="../favicon.png">

	<link href="../lib/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
	<link href="../lib/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>

	<link href="../styles/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="../styles/component.css" rel="stylesheet" type="text/css" />

	<!-- FONTAWESOME -->
	<link href="../lib/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<!-- RESPONSIVE GRID -->
	<link href="../lib/responsiveGrid/responsivegrid.css" rel="stylesheet">

	<!-- DROPZONE -->
	<link href="../lib/dropzone/basic.min.css" rel="stylesheet">
	<link href="../lib/dropzone/dropzone.min.css" rel="stylesheet">

	<!-- FORM VALIDATOR -->
	<link href="../lib/form-validator/theme-default.min.css" rel="stylesheet" type="text/css" />

	<!-- MAIN STYLESHEETS and JS -->
	<link href="../styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="main-container">

	<div id="body-box">

		<section id="side-menu-section">
			<?php include('../inc/menu-sidemenu.php') ?>
		</section><!-- ../endof #side-menu-section -->

		<section id="main-body-section">

			<div id="content-container">

				<div class="section group col span_2_of_2">
						
					<form id="promoForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.newsevents.php?action=update_newsevents">

						<div class="span-content-header">
							<h1>Update Article Details</h1>
						</div><!-- ../endof .span-content-header -->

						<input type="hidden" name="rno_id" value="<?= $rno['rno_id'] ?>">

						<div class="span-content-container form-add">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>
								
								<!-- STATUS -->
								<tr>
									<td>
										<label for="rno_status">Status <span class="highlight">*</span></label>
										<select id="rno_status" name="rno_status" tabindex="1">
											<option value="active" <?php if($rno['rno_status'] == 'active'){ echo 'selected'; } ?> >Active</option>
											<option value="disabled" <?php if($rno['rno_status'] == 'disabled'){ echo 'selected'; } ?> >Disabled</option>
										</select>
										<div class="remark">When an Article is <b>disabled</b>, it will not appear in the website.</div>
									</td>
								</tr>

								<!-- CATEGORY -->
								<tr>
									<td>
										<label for="rno_category_fk">Partner <span class="highlight">*</span></label>
										<select id="rno_category_fk" name="rno_category_fk" tabindex="2" required>
											<option readonly>Choose one</option>
											<?php foreach($categories as $category) { ?>
											<option value="<?= $category['category_id'] ?>" <?php if($rno['rno_category_fk'] == $category['category_id']) { echo 'selected'; } ?>  ><?= $category['category_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<!-- HEADER -->
								<tr>
									<td>
										<label for="rno_title">Article Title <span class="highlight">*</span></label>
										<input name="rno_title" id="rno_title" value="<?= $rno['rno_title'] ?>" type="text" placeholder="Get % Off / Save Pesos" tabindex="3"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min5"/>
									</td>
								</tr>

								<!-- PROMO PERIOD -->
								<tr class="no-divider">
									<td>
										<label>Period Coverage</label>
									</td>
								</tr>
								<tr class="no-divider">
									<!-- START DATE -->
									<td class="date-input">
										<label for="rno_date_start">Start Date</label>
										<input name="rno_date_start" id="rno_date_start" type="text" value="<?= $rno['rno_date_start'] ?>" class="datepicker" placeholder="YYYY-MM-DD" tabindex="4"
											data-validation="date"
											data-validation-optional="true" />
									</td>

									<!-- END DATE -->
									<td class="date-input">
										<label for="rno_date_end">End Date</label>
										<input name="rno_date_end" id="rno_date_end" type="text" value="<?= $rno['rno_date_end'] ?>" class="datepicker" placeholder="YYYY-MM-DD" tabindex="5"
											data-validation="date"
											data-validation-optional="true" />
									</td>
								</tr>
								<tr>
									<td>
										<div class="remark">
										When <b>START DATE</b> is blank, the <b>"Up to"</b> text will be shown at the beginning of the <b>Period Coverage</b> in the website.<br/>
										When only <b>END DATE</b> or both <b>START and END DATES</b> are blank, the News/Event will have no expiration or will be indefinite. The <b>Period Coverage</b> will not appear in the website.
										</div>
									</td>
								</tr>

								<!-- DESCRIPTION -->
								<tr class="no-divider">
									<td>
										<label>Description <span class="highlight">*</span></label>
										<div class="remark">About the latest News and/or Event. This will appear in the <b>Preview Thumbnail</b> in the website.</div>
									</td>
								</tr>
								<tr>
									<td>
										<textarea name="rno_subtitle" id="rno_subtitle" col="26" row="3" class="text-input" tabindex="6"><?= $rno['rno_subtitle'] ?></textarea>
									</td>
								</tr>

								<!-- IMAGE UPLOAD FIELD -->
								<tr>
									<td>
										<input type="hidden" name="rewards_image1" value="<?= $rno['rno_image'] ?>">

										<label>Featured Image <span class="highlight">*</span></label>
										<div class="preview-image rno-image">
											<img src="../../uploads/<?= $rno['rno_image'] ?>?v=<?= date("Y-m-d").date("h:i:sa"); ?>">	
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="rewards_image2">Replace Image?</label>
										<div class="remark"><b>Dimensions:</b> Width and Height must be 300 pixels(300x300)<br/><b>File Type:</b> JPG / JPEG only</div>
										<input type="file" name="rewards_image2" size="40" tabindex="7"
											data-validation="mime"
											data-validation-allowing="jpg, JPG, jpeg, JPEG"
											data-validation-error-msg-mime="Incorrect File Type"
											/>
									</td>
								</tr>

								<!-- YOUTUBE / VIDEO -->
								<tr>
									<td>
										<label>YouTube Video URL</label>
										<input type="text" name="rno_url" id="rno_url" tabindex="8" placeholder="https://www.youtube.com/watch?v=" value="<?= $rno['rno_url'] ?>" 
											data-sanitize="trim"
											data-validation="url"
											data-validation-error-msg="Input must be a valid YouTube link."
											data-validation-optional="true"/>
									</td>
								</tr>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="9">Update</button>
							<a href="manage-newsevents.php" class="cms-btn cancel-btn btn">Cancel</a>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	

				</div><!-- ../endof .section.group -->

				<?php if ($rno_gallery == true) : ?>
				<div class="section group col span_2_of_2">

					<div class="span-content-header">
						<h1>Manage Gallery</h1>
					</div>

					<form id="galleryOrganizer" enctype="multipart/form-data" class="form-organize" name="galleryOrganizer" method="post">

						<div class="go-container">
							<?php foreach ($rno_gallery as $img) { ?>
							<div id="item-<?= $img['image_id']; ?>" class="go-thumb">
								<a href="javascript:void(0);" class="btn-square go-delete" data-id="<?= $img['image_id']; ?>"><i class="fa fa-trash"></i></a>
								<input type="hidden" name="go-sequence[]" value="<?= $img['image_sequence'];?>">
								<img src="../../uploads/<?= $img['image_filename'];?>" alt="<?= $img['image_caption'];?>" title="<?= $img['image_caption'];?>">
								<div class="go-info">
									<div class="go-caption">
										<input id="caption-<?= $img['image_id']; ?>" class="go-caption" type="text" name="image_caption" value="<?= $img['image_caption'];?>">
									</div>
									
									<?php if (round($img['image_width']) > 1 && round($img['image_height']) > 1) { ?>
										<small><?= $img['image_width'];?> x <?= $img['image_height'];?></small>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
						</div>

					</form>

				</div>
				<?php endif; ?>


				<div class="section group col span_2_of_2">

					<div class="span-content-header">
						<h1>Upload Images for Gallery</h1>
					</div>

					<form id="galleryUploader" enctype="multipart/form-data" class="form-add" name="galleryUploader" method="post" action="../controller/controller.uploader.php?action=save_gallery&id=<?= $id; ?>">

						<div class="dropzone span-content-container">
							<div id="gallery-previews" class="dropzone-previews"></div>
							<div id="gallery-dropzone" class="dropzone"></div>
						</div>

						<div class="span-content-footer">
							<button type="submit" class="cms-btn btn" tabindex="9">Upload &amp; Save</button>
						</div>

					</form>

				</div>

				<?php $docCounter = 0; if ($rno_documents == true) : ?>
				<div class="section group col span_2_of_2">

					<div class="span-content-header">
						<h1>Manage Documents</h1>
					</div>

					<form id="documentOrganizer" enctype="multipart/form-data" class="form-organize" name="documentOrganizer" method="post">

						<div class="do-container">
							<?php foreach ($rno_documents as $doc) { $docCounter++; ?>
							<div id="doc-<?= $doc['doc_id']; ?>" class="do-row">
								<input type="hidden" name="do-sequence[]" value="<?= $doc['doc_sequence'];?>">
								<div class="do-1_of_3">
									<input id="do_caption-<?= $doc['doc_id']; ?>" class="do-caption" type="text" name="doc_title" value="<?= $doc['doc_title'];?>">
								</div>
								<div class="do-1_of_3">
									<a href="../../uploads/<?= $doc['doc_filename'];?>" target="_blank"><?= $doc['doc_filename'];?></a>
								</div>
								<div class="do-1_of_3">
									<a href="javascript:void(0);" class="action-btn do-delete" data-id="<?= $doc['doc_id']; ?>"><i class="fa fa-trash"></i> Delete</a>
								</div>
							</div>
							<?php } ?>
						</div>
					</form>

				</div>
				<?php endif; ?>


				<div class="section group col span_2_of_2">

					<div class="span-content-header">
						<?php $uploadLimit = 3 - $docCounter; ?>
						<h1>Upload PDF Documents (max. <?= $uploadLimit; ?> files)</h1>
					</div>

					<form id="documentUploader" enctype="multipart/form-data" class="form-add" name="documentUploader" method="post" action="../controller/controller.documents.php?action=save_documents&id=<?= $id; ?>&limit=<?= $uploadLimit; ?>">

						<div class="dropzone span-content-container">
							<div id="document-previews" class="dropzone-previews"></div>
							<div id="document-dropzone" class="dropzone"></div>
						</div>

						<div class="span-content-footer">
							<button id="save-docs" class="cms-btn btn" tabindex="10">Upload &amp; Save</button>
						</div>

					</form>

				</div>
				
			</div><!-- ../endof #content-container -->
			
		</section><!-- ../endof #main-body-section -->

	</div><!-- ../endof #body-box -->

</div><!-- ../endof #main-container -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- CKEDITOR -->
<script src="../ckeditor/ckeditor.js" type="text/javascript"></script>

<!-- FORM VALIDATOR -->
<script src="../scripts/custom-file-input.js" type="text/javascript"></script>
<script src="../lib/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<!-- JQUERY SORTABLE SCRIPT -->
<script>
    $(function() {
    	var draggedItem;

        $('#galleryOrganizer .go-container').sortable({
            containment: "parent",
            scroll: true,
            update: function (event, ui) {
                var sortable_data = $(this).sortable('serialize');
                console.log(sortable_data);

                $.ajax({
                    data: sortable_data,
                    type: 'POST',
                    url: '../controller/controller.gallery.php?action=sort_gallery',
                    success: function(data) {
                      console.log("Gallery Sorting - SUCCESS");
                    },
                    error: function(){
                      
                      console.log("Gallery Sorting - ERROR");
                    }
                });
            }
        });

        $(".go-thumb .go-caption").blur(function(){
        	var id = parseInt(this.id.split('-')[1]);

        	$.ajax({
                data: "id="+id+"&caption="+this.value,
                type: 'POST',
                url: '../controller/controller.gallery.php?action=update_gallery_info',
                success: function(data) {
                  console.log("Gallery Update - SUCCESS");
                },
                error: function(){
                  
                  console.log("Gallery Update - ERROR");
                }
            });
        });

        $(".go-delete").click(function(){
        	var id = $(this).attr('data-id');

        	if (confirm("Are you sure you want to delete this image from the gallery?") == true) {
        		$.ajax({
	                data: "id="+id,
	                type: 'POST',
	                url: '../controller/controller.gallery.php?action=delete_image',
	                success: function(data) {
	                  console.log("Image Delete - SUCCESS");
	                },
	                error: function(){
	                  
	                  console.log("Image Delete - ERROR");
	                }
	            });
        	} else {
        		return;
        	}
        });

        $('#documentOrganizer .do-container').sortable({
            containment: "parent",
            scroll: true,
            update: function (event, ui) {
                var sortable_data = $(this).sortable('serialize');
                console.log(sortable_data);

                $.ajax({
                    data: sortable_data,
                    type: 'POST',
                    url: '../controller/controller.documents.php?action=sort_documents',
                    success: function(data) {
                      console.log("Document Sorting - SUCCESS");
                    },
                    error: function(){
                      
                      console.log("Document Sorting - ERROR");
                    }
                });
            }
        });

        $(".do-caption").blur(function(){
        	var id = parseInt(this.id.split('-')[1]);

        	$.ajax({
                data: "id="+id+"&doc_title="+this.value,
                type: 'POST',
                url: '../controller/controller.documents.php?action=update_documents_info',
                success: function(data) {
                  console.log("Document Update - SUCCESS");
                },
                error: function(){
                  
                  console.log("Document Update - ERROR");
                }
            });
        });

        $(".do-delete").click(function(){
        	var id = $(this).attr('data-id');

        	if (confirm("Are you sure you want to delete this document from the article?") == true) {
        		$.ajax({
	                data: {"id": id},
	                type: 'POST',
	                url: '../controller/controller.documents.php?action=delete_documents',
	                success: function(data) {
	                  console.log("Document Delete - SUCCESS");
	                  location.reload();
	                },
	                error: function(){
	                  
	                  console.log("Document Delete - ERROR");
	                }
	            });
        	} else {
        		return;
        	}
        });

        $("#do-container").disableSelection();
        $("#go-container").disableSelection();
    });
</script>

<!-- DROPZONE -->
<script src="../lib/dropzone/dropzone.min.js"></script>
<script type="text/javascript">
Dropzone.autoDiscover = false;

var galleryDropzone  = $("#gallery-dropzone").dropzone({
	url                  : "../controller/controller.uploader.php?action=upload_gallery",
	addRemoveLinks       : false,
	maxFiles             : 10,
	autoProcessQueue     : true,
	uploadMultiple       : true,
	parallelUploads      : 1,
	maxThumbnailFilesize : 5,
	thumbnailWidth       : 240,
	thumbnailHeight      : 180,
	resizeWidth          : 1600,
	resizeMimeType       : 'image/jpeg',
	resizeQuality        : 0.6,
	acceptedFiles        : 'image/jpeg,image/jpg,image/png',
	paramName            : 'gallery_image',
	params               : {
		action : "upload_gallery"
	},
	previewsContainer    : "#gallery-previews",
	previewTemplate      : `<div class="img-preview">
								<input name="gallery_filename[]" id="gallery_filename" type="hidden"/>
                                <input name="gallery_fileW[]" id="gallery_fileW" type="hidden"/>
                                <input name="gallery_fileH[]" id="gallery_fileH" type="hidden"/>

                                <div class="dz-preview dz-file-preview">
                                  	<div class="dz-details">
                                    	<div class="dz-options">
                                      		<div class="va-block text-center">
                                        		<div class="va-middle">
                                    				<button class="dz-remove" data-dz-remove><i class="fa fa-trash"></i></button>
                                    				<div class="dz-filename"><span data-dz-name></span></div>
                                    				<div class="dz-size" data-dz-size></div>
                                        		</div>
                                      		</div>
                                    	</div>
                                    	<img data-dz-thumbnail />
                                  	</div>
                                  	<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                  	<div class="dz-error-message"><span data-dz-errormessage></span></div>
                                  	<div>
                                  		<label for="gallery_caption[]">Image Caption *</label>
                                    	<input type="text" name="gallery_caption[]" placeholder="Image Caption" required>
                                  	</div>
                                </div>
							</div>`,
  success              : function(file, responseText) {
    console.log(file);
    console.log(responseText);
    
    this.createThumbnailFromUrl(file, responseText.imageUrl);
    if (responseText.code == 1) {
        $('#general-error').html('<code>'+ responseText.messages +'</code>');
        var node, _i, _len, _ref, _results;
        var message = responseText.messages;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];

        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
        }
    } else {
        _ref = file.previewTemplate.querySelector('#gallery_filename');
        _ref.value = responseText.img;

        _refW = file.previewTemplate.querySelector('#gallery_fileW');
        _refW.value = responseText.imgW;

        _refH = file.previewTemplate.querySelector('#gallery_fileH');
        _refH.value = responseText.imgH;
    }
  },
  error                : function() {
    console.log("error");
  }
});

var docLimit = <?= $uploadLimit; ?>;

var documentDropzone  = $("#document-dropzone").dropzone({
	url                  : "../controller/controller.documents.php?action=upload_documents",
	addRemoveLinks       : false,
	maxFiles             : docLimit,
	autoProcessQueue     : true,
	uploadMultiple       : true,
	parallelUploads      : 1,
	acceptedFiles        : 'application/pdf',
	paramName            : 'document_file',
	params               : {
		action    : "upload_documents"
	},
	previewsContainer    : "#document-previews",
	previewTemplate      : `<div class="doc-preview">
                                <div class="dz-preview dz-file-preview">
                                  	<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                  	<div class="dz-error-message"><span data-dz-errormessage></span></div>
                                  	<div>
                                  		<input name="document_filename[]" id="document_filename" type="hidden"/>
                                  		<label for="document_title[]" class="dz-filename"><span data-dz-name></span> (<span class="dz-size" data-dz-size></span>)</label>
                                    	<input type="text" name="document_title[]" placeholder="Document Title">
                                  	</div>
                                </div>
							</div>`,
	init : function() {
		this.on("maxfilesexceeded",function(file){
			console.log("Limit reached!");
		});
	},
  	success              : function(file, responseText) {
	    console.log(file);
	    console.log(responseText);
	    
	    this.createThumbnailFromUrl(file, responseText.imageUrl);
	    if (responseText.code == 1) {
	        $('#general-error').html('<code>'+ responseText.messages +'</code>');
	        var node, _i, _len, _ref, _results;
	        var message = responseText.messages;
	        file.previewElement.classList.add("dz-error");
	        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
	        _results = [];

	        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
	            node = _ref[_i];
	        }
	    } else {
	        _ref = file.previewTemplate.querySelector('#document_filename');
	        _ref.value = responseText.doc;
	    }
	},
		error                : function() {
		console.log("error");
	}
});
</script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">
$(document).ready(function(){
	$("#menu-news").addClass('active');

	$(".datepicker").datepicker({
		dateFormat: "yy-mm-dd"
	});

	$("#rno_date_end").change(function(){
		if ($("#rno_date_start").val() != '') {
			if ($("#rno_date_start").val() >= $("#rno_date_end").val()) {
				$("#rno_date_end").val('')
			}
		}
	});

	$("#rno_date_start").change(function(){
		if ($("#rno_date_end").val() != '') {
			if ($("#rno_date_end").val() <= $("#rno_date_start").val()) {
				$("#rno_date_start").val('')
			}
		}
	});

	$.validate({
		form : '#promoForm',
		modules   : 'file, sanitize'
	});

	$("#save-docs").click(function(e){
		if (docLimit > 0) {
			$.validate({
				form : '#documentUploader',
				modules   : 'file, sanitize',
				onSuccess : function($form) {
					$("#documentUploader").submit();
				}
			});
		} else {
			e.preventDefault();
			alert("You have reached the maximum number of uploaded documents (3 files)! You cannot add another file.");
			return false;
		}
	});

	$("#menu-logout").click(function(){
		var name = $("#dname").val();
		if ( confirm("You are currently logged-in as " + name + ". Are you sure you want to sign out?") == true) {
			location.href='../logout.php';
		} else {
			return;
		}
	});

	/*CKEDITOR*/
	CKEDITOR.replace( 'rno_subtitle',
	{
		toolbar :
		[
			
			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'styles', items : [ 'Format' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor', 'NumberedList', 'BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize'] }
		]
	});
});
</script>

</body>
</html>