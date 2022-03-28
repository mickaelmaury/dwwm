function resize(source) {
    jQuery(".lightbox").html("<img src='" + source + "'>");
    jQuery(".lightbox").fadeIn("slow").css("display", "flex");
}
// Quand la page est prête
jQuery(function($) {
    // Ajout d'une balise <div> vide dans le <body>
    $('<div class="lightbox"></div>').prependTo('body');
    
    $('img').click(function(){
        var srcImage = $(this).attr('src');
        resize(srcImage);
        return false;
      });
    $(".lightbox").click(function () {
        $(".lightbox").fadeOut("fast");
    });
});
