
    function image_validate()
    {
        var extensions = new Array("jpg","jpeg");
        var image_file = document.regform.image.value;
        var image_length = document.regform.image.value.length;
        var pos = image_file.lastIndexOf('.') + 1;
        var ext = image_file.substring(pos, image_length);
        var final_ext = ext.toLowerCase();
        for (i = 0; i < extensions.length; i++)
    {
        if(extensions[i] == final_ext)
    {
        return true;

    }
    }
        alert("Image Extension Not Valid (Use Jpg,jpeg)");
        return false;
    }