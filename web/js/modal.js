$(document).ready(function() { 
  
    $('.modal').on('shown.bs.modal', function (e) {
        
        var id = e.currentTarget.id.replace("myModal", "");
        var iframe = $('#video_yt'+id);
        iframe.attr('src', iframe.prop('src') + '&autoplay=1');
    });

    $('.modal').on('hide.bs.modal', function (e) {
        var id = e.currentTarget.id.replace("myModal", "");
        var iframe = $('#video_yt'+id);
        iframe.attr('src', iframe.prop('src').replace('&autoplay=1',''));
    });

});