
var photo_counter = 0;
Dropzone.options.realDropzone = {

    uploadMultiple: false,
    maxFiles: 10,
    parallelUploads: 100,
    maxFilesize: 4,
    previewsContainer: '#dropzonePreview',
    addRemoveLinks: true,
    dictRemoveFileConfirmation: "Sicuro di voler cancellare questa immagine?",
    dictRemoveFile: 'x',
    dictFileTooBig: 'Le dimensioni dell\'immagine superano i 4MB consentiti',
    dictMaxFilesExceeded: 'Può essere caricata solo un\'immagine',
    thumbnailWidth: null,
    thumbnailHeight: null,

    // The setting up of the dropzone
    init:function() {

        // Add server images
        var myDropzone = this;

        $.get(url['get_img'], function(data) {

            var i = 0;
            $.each(data.images, function (key, value) {
                i++;
                var file = {id: value.id, name: value.original, size: value.size, accepted: true};
                myDropzone.emit("addedfile", file);
                myDropzone.createThumbnailFromUrl(file, url['path_blog_img'] + "/thumb-" + value.server );
                $(file.previewElement).prop('id', 'img_'+value.id);
                $(file.previewElement).addClass('dz-complete'); 
                //myDropzone.emit("complete", file);
            });
            
            if(i>0){
                $("#real-dropzone").addClass("dz-max-files-reached");
                var existingFileCount = i; // The number of files already uploaded
                myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
            }
            else
                $("form.dropzone").addClass("files-upload");

        })

        this.on("maxfilesexceeded", function(file) {
        });

        this.on("removedfile", function(file) {
            $.ajax({
                type: 'POST',
                url: url['delete_img'],
                data: {id: file.id, _token: $('#csrf-token').val()},
                dataType: 'html',
                success: function(data){
                    success('img-delete');
                    if($('.dropzone-previews .dz-preview').length > 0){
                        $("#dropzonePreview").trigger('sortupdate');
                    }else{
                        $(".panel.preview img").attr('src', '');
                        $(".panel.preview").addClass('hide');
                    }
                },
                error: function(data){

                    error('no-delete');
                }
            });

        });

        this.on("addedfile", function(file) {
            $("form.dropzone").removeClass("files-upload");
            
        });

        this.on("queuecomplete", function(queue) {
            $("#dropzonePreview").trigger('sortupdate');
        });
    },
    error: function(file, response) {
        if($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function(file,done) {
        file.id = done.id;
        $(file.previewElement).prop('id', 'img_'+file.id);
        if($('.dropzone-previews .dz-preview').length < 2){
            $(".panel.preview img").attr('src', url['path_blog_img']+"/"+done.filename);
            $(".panel.preview").removeClass('hide');
        }
    }
}