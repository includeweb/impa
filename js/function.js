var contenedor = {};
var json = [];
var json_active = [];
var timeout;
var result = {};

$(document).ready(function() {

    $('#buscador').keyup(function() {  
        if (timeout) {    
            clearTimeout(timeout);    
            timeout = null;  
        }

          
        timeout = setTimeout(function() {
            search();
        }, 100);
    });


    $("body").on('change', '#result', function() {
        result = $("#result").val();
        load_content(json);
    });

    $("body").on('click', '.asc', function() {
        var name = $(this).parent().attr('rel');
        console.log(name);
        $(this).removeClass("asc").addClass("desc");
        order(name, true);
    });

    $("body").on('click', '.desc', function() {
        var name = $(this).parent().attr('rel');
        $(this).removeClass("desc").addClass("asc");
        order(name, false);
    });

});

function update(id,parent,valor){
    for (var i=0; i< json.length; i++) {
        if (json[i].id === id){
            json[i][parent] = valor;
            return;
        }
    }
}

function load_content(json) {

    max = result;
    data = json.slice(0, max);
    json_active = json;
    $("#numRows").html(json.length);
    contenedor.html('');
    2

    var list = table.find("th[rel]");
    var html = '';

    $.each(data, function(i, value) {
        html += '<tr id="' + value.id + '">';
        $.each(list, function(index) {

            valor = $(this).attr('rel');

            if (valor != 'acction') {
                if ($(this).hasClass("editable")) {
                    html += '<td><span class="edition" rel="' + value.id + '">' +  value[valor] .substring(0, 60) +'</span></td>';
                } else if($(this).hasClass("view")){
                    if(value[valor].length > 1){
                        var class_1 = $(this).data('class');
                        html += '<td><a  href="javascript:void(0)" class="'+class_1+'" rel="'+ value[valor] + '" data-id="' + value.id + '"></a></td>';
                    }else{
                         html += '<td></td>';
                    }
                   
                }else{
                    html += '<td>' + value[valor] + '</td>';
                }

            } else {

                html += '<td>';
                $.each(acction, function(k, data) {
                    html += '<a class="' + data.class + '" rel="' + value[data.rel] + '" href="' + data.link + value[data.parameter] + '"  target="'+data.target+'" >' + data.button + '</a>';
                });
                html += "</td>";
            }

            if (index >= list.length - 1) {
                html += '</tr>';
                contenedor.append(html);
                html = '';
            }
        });
    });

}

function selectedRow(json) {

    var num = result;
    var rows = json.length;
    var total = rows / num;
    var cant = Math.floor(total);
    $("#result").html('');
    for (i = 0; i < cant; i++) {
        $("#result").append("<option value=\"" + parseInt(num) + "\">" + num + "</option>");
        num = num + result;
    }
    $("#result").append("<option value=\"" + parseInt(rows) + "\">" + rows + "</option>");

}

function order(prop, asc) {
    json = json.sort(function(a, b) {
        if (asc) return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
        else return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
    });
    contenedor.html('');
    load_content(json);
}


function search() {

    var list = table.find("th[rel]");
    var data = [];
    var serch = $("#buscador").val();

    json.forEach(function(element, index, array) {

        $.each(list, function(index) {
            valor = $(this).attr('rel');

            if (element[valor]) {
                if (element[valor].like('%' + serch + '%')) {
                    data.push(element);
                    return false;
                }
            }

        });

    });

    contenedor.html('');
    load_content(data);

}

String.prototype.like = function(search) {

    if (typeof search !== 'string' || this === null) {
        return false;
    }
    search = search.replace(new RegExp("([\\.\\\\\\+\\*\\?\\[\\^\\]\\$\\(\\)\\{\\}\\=\\!\\<\\>\\|\\:\\-])", "g"), "\\$1");
    search = search.replace(/%/g, '.*').replace(/_/g, '.');
    return RegExp('^' + search + '$', 'gi').test(this);
}


function export_csv(JSONData, ReportTitle, ShowLabel) {
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    
 //   CSV += ReportTitle + '\r\n\n';

    if (ShowLabel) {
        var row = "";

        for (var index in arrData[0]) {

            row += index + ';';
        }

        row = row.slice(0, -1);

        CSV += row + '\r\n';
    }

    for (var i = 0; i < arrData.length; i++) {
        var row = "";

        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '";';
        }
        row.slice(0, row.length - 1);
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
 //   var fileName = "Report_";
//fileName += ReportTitle.replace(/ /g,"_");   
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    var link = document.createElement("a");    
    link.href = uri;
    link.style = "visibility:hidden";
    link.download = ReportTitle + ".csv";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}