$(document).ready(function(){
    applyFilters();
    //wanneer een item met klasse "search" changed wordt of er in een invoerveld wordt getypt
    $('.search').on('change keyup', applyFilters);



});

function applyFilters() {
    //toon alle rows die mogelijk nog hidden staan
    $('.row').show();
    //voor elk element van de searchlass
    $('.search').each(function(index, filterElement) {
        //voor elke instantie van search haal je de filtervalue op
        //let: scoped naar de dichtsbeizijnde enclosing blok, wat kleiner kan zijn dan een function block
        //var: scpoped tot de dichtsbeizijnde  functie blok
        let filterValue = $(filterElement).val();
        //als de currfent filtervalue niet bestaat of leeg is(bv op All staat) ga naar het volende element
        if(!filterValue || filterValue === '' ) {
            return;
        }
        //haal van je current element de target op (zodat je weet op welke value je moet gaan zoeken)
        //foreach alle divs die deze target als class hebben
        $('.' + $(filterElement).data('target')).each(function(index, searchableElement){
            //searchablevalue is de text waarde van het element dat je gaat vergelijken met de filter
            let searchableValue = $(searchableElement).text();
            //maak een regularexpression om lowercase te kunnen matchen
            let re = new RegExp($(filterElement).val(), 'i');
            //Als de filter niet matcht met de text van het element
            if(!searchableValue.match(re)) {
                //hide het element
                $(searchableElement).closest('.row').hide();
            }
        });
    });
}