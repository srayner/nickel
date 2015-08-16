$(document).ready( function() {
    
    $('#file-input').change(function(e) {

        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i];
        
            img = document.getElementById('avatar-img');
            var reader = new FileReader();
            reader.onloadend = function() {
                img.src = reader.result;
            };
            reader.readAsDataURL(file);
            $('#submit').replaceWith('<button class="btn btn-success">Upload</button>');
        }
    });

});