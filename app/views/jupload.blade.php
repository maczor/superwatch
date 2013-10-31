<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Upload images</h4>
		</div>
		<div class="modal-body">
			<button class="btn btn-large btn-success fileinput-button">
			    <span class="glyphicon glyphicon-plus"></span>
			    <span>Drag and drop images here or press button to Add images.</span>
			    <!-- The file input field used as target for the file upload widget -->
			    <input id="fileupload" type="file" name="files[]" multiple>
			</button>
			<br>
			<br>
			<!-- The global progress bar -->
			<div id="progress" class="progress progress-striped">
			    <div class="progress-bar progress-bar-success" role="progressbar"></div>
			</div>
			<!-- The container for the uploaded files -->
			<div id="files" class="files"></div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/jQuery-File-Upload-master/js/tmpl.min.js"></script>

<script src="/jQuery-File-Upload-master/js/main.js"></script>
</html>