/**
 * Created by rzhamaletdinov on 18.05.16.
 */


function checkValid(value, submitName)
{
    var check = value.every(function(item) {
        return $(item).val() ? setValid(item) : setInvalid(item);
    });

    if(check)
        $(submitName).prop('disabled', false);
    else
        $(submitName).prop('disabled', true);
}

function setValid(item)
{
    $(item).addClass("form-control-success");
    $(item).next().addClass("input-group-addon-success");
    return true;
}

function setInvalid(item)
{
    $(item).removeClass("form-control-success");
    $(item).next().removeClass("input-group-addon-success");
    return false;
}


$( "#EmailSendName" ).keyup(function() {
    checkValid(['#EmailSendName', '#EmailSendContact', '#EmailSendMessage'],'#sumbitEmailSend');
});

$( "#EmailSendContact" ).keyup(function() {
    checkValid(['#EmailSendName', '#EmailSendContact', '#EmailSendMessage'],'#sumbitEmailSend');
});

$( "#EmailSendMessage" ).keyup(function() {
    checkValid(['#EmailSendName', '#EmailSendContact', '#EmailSendMessage'],'#sumbitEmailSend');
});

$( "#callbackPhone" ).keyup(function() {
    checkValid(['#callbackPhone'],'#sumbitCallback');
});