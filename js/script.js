/*const lesson = document.querySelector('.student-lessons-btn');
const changes = document.querySelector('.student-changes-btn');
const lessonContent = document.querySelector('.student-lessons-content');
const changesContent = document.querySelector('.student-changes-content');
const departamentsUk = document.querySelector('.departaments-uk-btn');
const departamentsAd = document.querySelector('.departaments-ad-btn');
const departamentsTm = document.querySelector('.departaments-tm-btn');
const departamentsUkContent = document.querySelector('.departaments-uk-content');
const departamentsAdContent = document.querySelector('.departaments-ad-content');
const departamentsTmContent = document.querySelector('.departaments-tm-content');
let lessonClick = false;
let changeClick = false;
let departamentsUkClick = false;
let departamentsAdClick = false;
let departamentsTmClick = false;
if(lesson){
    lesson.addEventListener('click', function(){
        if(!lessonClick){
            lessonContent.style.display = "block";
            lessonClick = true;
        } else if(lessonClick){
            lessonContent.style.display = "none";
            lessonClick = false;
        }
    })
}

if(changes){
    changes.addEventListener('click', function(){
        if(!changeClick){
            changesContent.style.display = "block";
            changeClick = true;
        } else if(changeClick){
            changesContent.style.display = "none";
            changeClick = false;
        }
    })
}

if(departamentsUk){
    departamentsUk.addEventListener('click', function(){
        if(!departamentsUkClick){
            departamentsUkContent.style.display = "block";
            departamentsUkClick = true;
        } else if(departamentsUkClick){
            departamentsUkContent.style.display = "none";
            departamentsUkClick = false;
        }
    })
}

if(departamentsAd){
    departamentsAd.addEventListener('click', function(){
        if(!departamentsAdClick){
            departamentsAdContent.style.display = "block";
            departamentsAdClick = true;
        } else if(departamentsAdClick){
            departamentsAdContent.style.display = "none";
            departamentsAdClick = false;
        }
    })
}

if(departamentsTm){
    departamentsTm.addEventListener('click', function(){
        if(!departamentsTmClick){
            departamentsTmContent.style.display = "block";
            departamentsTmClick = true;
        } else if(departamentsTmClick){
            departamentsTmContent.style.display = "none";
            departamentsTmClick = false;
        }
    })
}*/

/*let rel_btn = document.querySelector("#reload");
rel_btn.addEventListener("click", ()=> window.location.reload());*/
function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}
var out = '';
function readFile(input, mass) {
    let file = input.files[0];

    let reader = new FileReader();



    reader.readAsText(file);

    reader.onload = function () {
        if (mass) {
            import_ras(reader.result.replace(/[\n\r]+/g, '&').trim().split("&"));
        } else {
            import_mes(reader.result)
        }
        
    };

    reader.onerror = function () {
        console.log(reader.error);

    };
    console.log(out);

}
function import_ras(txt) {
    for (let i = 1; i < 7; i++) {
        if (txt[i - 1] === '-') {
            document.getElementById("l" + i.toString()).value = "";
        } else {
            document.getElementById("l" + i.toString()).value = txt[i - 1];
        }

    }
}
function import_mes(txt) {
    document.getElementById("mess").innerText = txt;
}