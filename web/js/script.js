$(document).ready(function(){
    
    $('.search').on('keyup', function () {
        var searchTerm = $(this).val();
        $('.issue-name').each(function(index, searchableElement){
            var searchableValue = $(searchableElement).text();
            if(searchableValue.search(searchTerm) === -1 )
            {
                $(searchableElement).closest('.row').hide();
            }
            else
            {
                $(searchableElement).closest('.row').show();
            }
        })
    })


    console.log('amma chargin mah laser!');
    var $linkArray = [];

    $('.addToMail').on("click", function(){
        var name = $(this).attr("name");
        $(this).val('Undo add to mail');
        $(this).addClass('undo').removeClass('addToMail');
        $linkArray.push(name);
        console.log('the laser has been charged with' + name);
        console.log($linkArray);
    });

    $('.undo').on("click", function(){
        console.log("you've done it now, the laser fired!");
    });

});