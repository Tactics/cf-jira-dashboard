$(document).ready(function(){
    console.log('amma chargin mah laser!');
    var $linkArray = [];
    $('.addToMail').on("click", function(){
        var name = $(this).attr("name");
        $(this).prop('disabled', true);
        $linkArray.push(name);
        console.log('the laser has been charged with' + name);
        console.log($linkArray);
    });

    $("p").click(function(){
        $(this).hide();
    });
});