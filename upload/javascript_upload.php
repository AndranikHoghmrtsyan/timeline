<form enctype="multipart/form-data">
    <input name="file" type="file" id="file1" style="display:none"/>
    <input type="button" value="Upload" style="display:none"/>
    <label id="image"for="file1"><img src="009.jpg"style="width:100px;height:60px"></label>
</form>
<progress></progress>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(':file').on('change', function() {
   
$(':button').trigger( "click" );

    // Also see .name, .type
});
</script>
<script>
$(':button').on('click', function() {
    $.ajax({
        // Your server script to process the upload
        url: 'upload.php',
        type: 'POST',

        // Form data
        data: new FormData($('form')[0]),

        // Tell jQuery not to process data or worry about content-type
        // You *must* include these options!
        cache: false,
        contentType: false,
        processData: false,

        // Custom XMLHttpRequest
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                // For handling the progress of the upload
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        $('progress').attr({
                            value: e.loaded,
                            max: e.total,
                        });
                    }
                } , false);
            }
            return myXhr;
        },
        success:function(d){
         $('img').attr("src", d);

        }
    });
});
</script>