/*$(document).on('click', '.boton_url', function () {
    let address = $('#search_address').val();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/addressFull?address='+address,
        type: 'get',
        data: address,
        success: function (data) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", data.url, true);
            xhttp.onreadystatechange = function (aEvt) {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200)
                        dump(xhttp.responseText);
                    else
                        dump("Error loading page\n");
                }
            };
            //xhttp.send();
            console.log(data);
            abir();
        },
        error: function (data) {
            dump(data);
        }
    })
})*/

/*
$(document).on('click', '.boton_url', function () {
    let address = $('#search_address').val();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/addressFull?address='+address,
        type: 'get',
        data: address,
        success: function (data) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", data.url, true);
            xhttp.onreadystatechange = function (aEvt) {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200)
                        dump(xhttp.responseText);
                    else
                        dump("Error loading page\n");
                }
            };
            //xhttp.send(data);
            console.log(data);
            $(".alert").show();
            $(".alert").html(data);
        },
        error: function (data) {
            dump(data);
        }
    })
})

$(document).on('click', '.boton_url', function () {
    let address = $('#search_address').val();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/addressFull?address='+address,
        type: 'get',
        data: address,
        success: function (data) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", data.url, true);
            xhttp.onreadystatechange = function (aEvt) {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200)
                        dump(xhttp.responseText);
                    else
                        dump("Error loading page\n");
                }
            };
            //xhttp.send(data);
            console.log(data);
            $(".alert").show();
            $(".alert").html(data);
        },
        error: function (data) {
            dump(data);
        }
    })
})
*/



$(document).on('click', '.boton_url', function () {
    let address = $('#search_address').val();
    $.ajax({
        url: '/callAddress',
        type: 'get',
        data: {'address': address},
        success: function (data) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", data.url, true);
            xhttp.onreadystatechange = function (aEvt) {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200)
                        dump(xhttp.responseText);
                    else
                        dump("Error loading page\n");
                }
            };
            //xhttp.send(data);
            console.log(data);
            $(".alert").show();
            //$(".alert").html(data);
            $(".alert").html(data.success);  //data.success es la variable que se imprime en la view
        },
        error: function (data) {
            dump(data);
        }
    })
})

//----------------
$(document).on('click','.addImage',function(event){  console.log("click addImage");
    $(this).ajaxPost('addressFull','GET','principalPanel');
})

$(document).on('click','.deleteImage',function(event){
    var id = $(this).attr('data-id');
    $(this).ajaxPost('images/'+id,'DELETE','/');
});

$.fn.ajaxPost = function(url,method,sectionToRender) {  console.log("url: "+ url+ " method: " + method + " sectionRender: " + sectionToRender  );
    $.ajax({
        type: method,
        url: url,
        dataType: 'json',
        success: function (data) {
            ajaxRenderSection(sectionToRender)
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function ajaxRenderSection(url) {  console.log("url1" +  url);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}
//------------------