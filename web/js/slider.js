$(document).ready(function(){
    $(".flip").click(function(){
        $("#panel_"+this.id.substring(5)).slideToggle("slow");
    });
});
