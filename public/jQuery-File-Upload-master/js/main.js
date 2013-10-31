/*
 * jQuery File Upload Plugin JS Example 8.8.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

 /*jslint nomen: true, regexp: true */
 /*global $, window, blueimp */

 $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/uploaded/';

    $('#fileupload').fileupload({
        //formData: {id: $('input[name=watchid]').val()},
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 10000000, // 10 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
        .test(window.navigator.userAgent),
        previewMaxWidth: 200,
        previewMaxHeight: 200,
        previewCrop: true,
    }).on('fileuploadadd', function (e, data) {
    	$('.modal-footer button, .modal-header button').addClass('disabled');
        data.context = $('<div/>').appendTo('#files');
        // $.each(data.files, function (index, file) {
        //     var node = $('<p/>')
        //     .append($('<span/>').text(file.name));
        //     if (!index) {
        //         node
        //         .append('<br>')
        //     }
        //     node.appendTo(data.context);
        // });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
        file = data.files[index],
        node = $(data.context.children()[index]);
        // if (file.preview) {
        //     node
        //     .prepend('<br>')
        //     .prepend(file.preview);
        // }
        if (file.error) {
            node
            .append('<br>')
            .append(file.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
            );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
            .attr('target', '_blank')
            .prop('href', file.url);
            $(data.context.children()[index])
            .wrap(link);
            addImagesToWatch(file);
        });
        $('.modal-footer button, .modal-header button').removeClass('disabled');
    }).on('fileuploadfail', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
            .append('<br>')
            .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
    .parent().addClass($.support.fileInput ? undefined : 'disabled');
});