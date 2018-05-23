$(document).ready(function(){

    $('.search').on('keyup', function () {
        var searchTerm = $(this).val();
        console.log('data:' , $(this).data('target'));

        $('.' + $(this).data('target')).each(function(index, searchableElement){
            var searchableValue = $(searchableElement).text();
            if(searchableValue.search(searchTerm) === -1 )
            {
                $(searchableElement).closest('.row').hide();
            }
            else
            {
                $(searchableElement).closest('.row').show();
            }
        });
    });

    $('.search').change(function(){
        var searchTerm = $(this).val();
        $('.' + $(this).data('target')).each(function(index, searchableElement){
            var searchableValue = $(searchableElement).text();
            if(searchTerm === 'Reopened')
            {
                console.log(searchableValue);
                if(!(searchableValue.search(searchTerm) === -1) || !(searchableValue.search('Open') == -1))
                {
                    $(searchableElement).closest('.row').show();
                }
                else
                {
                    $(searchableElement).closest('.row').hide();
                }
            }
            else if(searchTerm ==='All' || !(searchableValue.search(searchTerm) === -1))
            {
                $(searchableElement).closest('.row').show();
            }
            else
            {
                $(searchableElement).closest('.row').hide();
            }
        })
    });


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