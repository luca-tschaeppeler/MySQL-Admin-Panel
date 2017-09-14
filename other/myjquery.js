function is_ready(){
 $("#open").click(open_popup);
 $("#close").click(close_popup);
}

function open_popup(){
 $("#popup").css("display", "block");
}

function close_popup(){
 $("#popup").css("display", "none");
}


$(document).ready(is_ready);
