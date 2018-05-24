$(document).ready(function(){
    filter();
    //wanneer een item met klasse "search" changed wordt of er in een invoerveld wordt getypt
    $('.search').on('change keyup', filter);
    $('.filterPlets').on('change', filter);


});
function filter(){
    generalFilters();
    pletsenFilter();
}

function generalFilters() {
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

function pletsenFilter() {
    $('.issues').each(function (index, issue) {
        let allForDoneChecked = $(this).find('.customDone').text()
        let issueState = $(this).find('.issue-status').text();
        if ((issueState === 'Resolved' || issueState === 'Closed') && !allForDoneChecked) {
            $(this).css('background-color', '#f47a42');
            return;
        }
        if($('.filterPlets').prop('checked')) {
            $(this).hide();
        }
    });
}

function copyToClipboard () {
    // Create a new textarea element and give it id='temp_element'
    var textarea = document.createElement('textarea');
    textarea.id = 'temp_element';
    // Optional step to make less noise on the page, if any!
    textarea.style.height = 0
    // Now append it to your page somewhere, I chose <body>
    document.body.appendChild(textarea);
    // Give our textarea a value of whatever inside the div of id=containerid
    $('.issues').each(function(index, issue){
        if(($(this).find('.issue-status').text()) === 'Resolved') {
            var link = $(this).find('.issue-link').text();
            var key = $(this).find('.issue-name').text();
            textarea.value += key + ": " + link + '\n';
        }
    });
    //textarea.value = document.getElementsByClassName('issues').innerHTML;
    // Now copy whatever inside the textarea to clipboard
    var selector = document.querySelector('#temp_element');
    selector.select();
    document.execCommand('copy');
    // Remove the textarea
    document.body.removeChild(textarea);
    alert("copied done's to clipbaord");
}