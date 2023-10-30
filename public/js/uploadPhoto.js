document.getElementById("photo1").onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById("photoimg1").src = fr.result;
        };
        fr.readAsDataURL(files[0]);
    }
};

document.getElementById("photo2").onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById("photoimg2").src = fr.result;
        };
        fr.readAsDataURL(files[0]);
    }
};

document.getElementById("photo3").onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById("photoimg3").src = fr.result;
        };
        fr.readAsDataURL(files[0]);
    }
};

document.getElementById("photo4").onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById("photoimg4").src = fr.result;
        };
        fr.readAsDataURL(files[0]);
    }
};
