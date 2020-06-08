function fileContentLoader(target, fileName, data={date:0}){
    target.load(`pages/${fileName}`,data,function(response, status,detail){        
         if(status === 'error'){
            $("#container").html(`<p class="text-center alert alert-danger col">Le contenu demandé est introuvable!</p>`);
            //ou bien
            //$("#table").html(`<p class="text-center alert alert-danger col">Code Erreur : ${detail.status}, ${detail.statusText}</p>`);
        }
    });
}


//Events
$('form')

$(document).ready(function(){
    const nav = $('#nav');
    const container = $('#container');
    
    fileContentLoader(nav, 'navbar.php');
    fileContentLoader(container, 'connexion.php');
    //fileContentLoader(container, 'connexion.php', { date: 1 });
})

//Link
$('.nav-link').click(function(e){
    const nav = $('#nav');
    const container = $('#container');
    if(e.target.id === 'connexion_user'){
        fileContentLoader(nav, 'navbar.php');
        fileContentLoader(container, 'connexion.php');
        //fileContentLoader(table, 'table.php', { date: 1 });
    }else if(e.target.id === 'inscription'){
       // fileContentLoader(form,'formSearch.php');
        fileContentLoader(container,'inscription.php');
    }
});