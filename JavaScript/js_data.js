/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
     var count_beschreibung = 0;
     var count_kategorie = 0;
    $('#suchfeld_beschreibung').hide();
    $('#suchfeld_kategorie').hide();

    $('#suche_beschreibung').click(function() {
        count_beschreibung ++;
        
        if(count_beschreibung%2 == 0 ) {
            $('#suchfeld_beschreibung').hide();
            $('#suche_beschreibung').attr('checked', false);
        } else {
            $('#suchfeld_beschreibung').show();
            $('#suche_beschreibung').attr('checked', true);
        }
        
    });


    $('#suche_kategorie').click(function() {
        
        count_kategorie ++;
        
     if(count_kategorie%2 == 0 ) {
            $('#suchfeld_kategorie').hide();
            $('#suche_kategorie').attr('checked', false);
        } else {
            $('#suchfeld_kategorie').show();
            $('#suche_kategorie').attr('checked', true);
        }
        
    });

});