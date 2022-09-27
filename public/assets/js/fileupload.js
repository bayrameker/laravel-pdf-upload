/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function renderPDF(url, canvasContainer, options) {

    options = options || {scale: 3};

    function renderPage(page) {
        var viewport = page.getViewport(options.scale);
        var wrapper = document.createElement("div");
        wrapper.className = "canvas-wrapper";
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        ctx.imageSmoothingEnabled = true;
        var renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };

        canvas.height = viewport.height;
        canvas.width = viewport.width;
        canvas.style.width = "70%";

        wrapper.appendChild(canvas)
        canvasContainer.appendChild(wrapper);

        page.render(renderContext);
    }

    function renderPages(pdfDoc) {
        for (var num = 1; num <= pdfDoc.numPages; num++)
            pdfDoc.getPage(num).then(renderPage);
    }

    PDFJS.disableWorker = true;
    PDFJS.getDocument(url).then(renderPages);

}


function fileIsValid(fileName) {
    var ext = fileName.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    var isValid = true;
    switch (ext) {
        case 'pdf':
            break;
        default:
            this.value = '';
            isValid = false;
    }
    return isValid;
}

function VerifyFileNameAndFileSize($e) {
    var file = document.getElementById('GetFile').files[0];
    if (file != null) {
        var fileName = file.name;
        if (fileIsValid(fileName) == false) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.warning("Invalid file format. Please select only pdf file");

            document.getElementById('GetFile').value = null;
            return false;
        }

        var size = file.size;
        if ((size != null) && (size > 1000000)) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.warning("File size should not be more then 10MB");

            document.getElementById('GetFile').value = null;
            return false;
        }

        $e.closest("form").submit();
        return true;
    } else
        return false;
}

$(document).on('click', '.docViewList li', function (e) {
    e.stopPropagation();
    var sel = $(this).attr('data-id');
    var sthis = $(this);

    $.ajax({
        url: "getView",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: sel
        },
        beforeSend: function () {
            $(".viewer").hide();
            $(".note").show().html('Loading...');
        },
        success: function (res) {

            if (res.flag == 0) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);
            } else {

                sthis.addClass('active').siblings().removeClass('active');

                $(".viewer").show();
                $(".note").hide();
                $(".doc-header").html("Document #" + sel);

                $("#holder").html('');
                renderPDF(res.file_url, document.getElementById('holder'));
            }
        }
    });
});
