$(document).ready(function(){
    $("img.lazy").lazyload({
        event : "sporty",
        effect: "fadeIn"
    });
    var timeout = setTimeout(function() {  
        $("img.lazy").trigger("sporty");
    }, 400);  
});