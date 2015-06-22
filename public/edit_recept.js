$(document).ready(function() {
    temp = "";
    $('.seslist').on('click', function(){
        //$('#delit').value = $('#delit').attr('value')+$(this).attr('value')+";;";
        document.getElementById("delit").value = document.getElementById("delit").value+$(this).attr('value')+";;";
        $(this).hide();
        //temp = temp + $(this).parent().getPropertyValue()+";;";
    });
});