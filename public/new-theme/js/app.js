$(document).ready(function () {
    if (screen.width > 991) {
        $(".sidebarApp").hover(
            function () {
                //find the image in the container
                $(".addOver").addClass("over");
            },
            function () {
                //find the image in the container
                $(".addOver").removeClass("over");
            }
        );
    }
});

function onUploadFilePreviewCard(myFile, id, tranuploadfile, fileName) {
    return;
    let file = myFile.files[0];
    const uploadFileBox = document.getElementById(id);

    uploadFileBox.classList.add("filePreview");
    uploadFileBox.classList.remove("uploadFileBox");
    document.querySelector(`#${id} .uploadFileBoxContent `).style.display =
        "none";

    console.log(myFile.files, "myFile from  onUploadFilePreviewCard");

    uploadFileBox.innerHTML += `
        <div class="filePreview" style="width: 100%">
            <div class="icon">
                <img src="/new-theme/icons/folder.svg" alt="" />
            </div>
            <div class="info flex align between">
                <div>
                    <h4>${file.name}</h4>
                    <p>${file.size}Kb</p>
                </div>
                <div class="flex align gap-3">
                    <img src="/new-theme/icons/view.svg" class="iconImg" />
                    <img src="/new-theme/icons/delete.svg" class="iconImg" onclick="resetInputPreview('${id}','${tranuploadfile}', '${fileName}');" />
                </div>
            </div>
        </div>
    `;
}

function onUploadFilePreviewCard2(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);

    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}

function resetInputPreview(id, tranuploadfile, fileName) {
    const uploadFileBox = document.getElementById(id);

    uploadFileBox.classList.remove("filePreview");
    console.log(id, "id =========");

    uploadFileBox.innerHTML = `
    <div class="uploadFileBox" id="uploadFileBox${id}">
        <div class="uploadFileBoxContent flex align gap-3">
            <div class="uploadInput">
                <img src="/new-theme/icons/upload.svg" alt="" />
                <input type="file" name="${fileName}" onchange="onUploadFilePreviewCard(this,'uploadFileBox${id}' , '${tranuploadfile}', '${fileName}');" />
            </div>
            <div class="title">${tranuploadfile}</div>
        </div>
    </div>
    `;
}

var addOver = document.querySelector(".addOver");
var appClass = document.querySelector(".app"); // the container for the variable content

$(".showMenu").click(function () {
    //  $('.addOver').toggle('showMenuForMobile')
    appClass.classList.toggle("showMenuForMobile");
    addOver.classList.toggle("over");
});

window.addEventListener("resize", function (event) {
    if (screen.width > 991) {
        appClass.classList.remove("showMenuForMobile");
        addOver.classList.remove("over");
    }
});
