<style>
    .menu
    {
        position:relative;
        width:110%;
        left:-10%;
        background-color:#C4C4C4;
        border:10px solid white;
        border-radius:10%;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.5);
    }
    .left
    {
        /* background-color:rgb(196,196,196,0.2); */
        background: #C4C4C4;
border: 2px solid #FFFFFF;
box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.5);
    }

    .right
    {

        background-color:#C4C4C4;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.5);
    }
    .ic
    {
       width:40px;
       height:40px;
    }
    .btn-menu
    {
        background-color:#3C716D;
        font-weight:bold;

    }
</style>
<div class="container-fluid p-0 col-md-11 col-sm-11 col-11 ">
    <div class="row  justify-content-around" >
        <div class="left col-md-3 col-sm-3 col-3 border-white border rounded-sm ">
         <br>
            <div id="dashboard"  class="menu row dashboard  p-3 border-white border rounded-sm  justify-content-around">
   
               <img class="ic" src="./assets/images/icones/equalizer-24px.svg" alt="">
               
                <button class="btn-menu border-0 col-sm-8 col-md-7 d-none d-sm-block col-lg-7 rounded-sm small justify-content-center text-white p-3 p-sm-2" >DASHBOARD</button>
            </div>

         <br>
            <div id="joueurs"  class="menu row dashboard  p-3 border-white border rounded-sm  justify-content-around">
   
               <img class="ic" src="./assets/images/icones/group_add-24px.svg" alt="">
               
                <button class="btn-menu border-0 col-sm-8 col-md-7 d-none d-sm-block   col-lg-7 rounded-sm small justify-content-center text-white p-3 p-sm-2" >LISTE UTILISATEURS</button>
            </div>

         <br>
            <div id="inscription"  class="menu row dashboard  p-3 border-white border rounded-sm justify-content-around">
   
               <img class="ic" src="./assets/images/icones/person_add-24px.svg" alt="">
               
                <button class="btn-menu border-0 col-sm-8 col-md-7  d-none d-sm-block col-lg-7 rounded-sm small justify-content-center text-white p-3 p-sm-2" >CREER ADMIN</button>
            </div>

         <br>
            <div id="listequestion" class="menu row dashboard  p-3 border-white border rounded-sm  justify-content-around">
   
               <img class="ic" src="./assets/images/icones/ballot-24px.svg" alt="">
               
                <button class="btn-menu border-0 col-sm-8 col-md-7 d-none d-sm-block  col-lg-7 rounded-sm small justify-content-center text-white p-3 p-sm-2" >LISTE QUESTIONS</button>
            </div>

         <br>
            <div id="creerquestion"  class="menu row dashboard  p-3 border-white border rounded-sm  justify-content-around">
   
               <img class="ic" src="./assets/images/icones/create-24px.svg" alt="">
               
                <button class="btn-menu border-0 col-sm-8 col-md-7 d-none d-sm-block  col-lg-7 rounded-sm small justify-content-center text-white p-3 p-sm-2" >CREER QUESTIONS</button>
            </div>
        <br>
        </div>
        <div id="container_admin" class="push-right right col-md-8 col-sm-8 col-lg-8 col-8 border-white border rounded-sm">
        fdkhfshdk fdkhfshdk fdkhfshdk fdkhfshdkfdkhfshdk fdkhfshdk fdkhfshdk
        </div>
    </div>
</div>

<script>
    
$('.menu').click(function(e){

    const container_amin = $('#container_admin');
    if(e.target.id === 'creerquestion'){
        fileContentLoader(container_amin, 'creerquestion.php');
        //fileContentLoader(container, 'connexion.php');
        //fileContentLoader(table, 'table.php', { date: 1 });
    }else if(e.target.id === 'inscription'){
       // fileContentLoader(form,'formSearch.php');
        fileContentLoader(container_amin,'inscription.php');
    }else if(e.target.id === 'listequestion'){
       // fileContentLoader(form,'formSearch.php');
        fileContentLoader(container_amin,'listequestion.php');
    }else if(e.target.id === 'joueurs'){
       // fileContentLoader(form,'formSearch.php');
        fileContentLoader(container_amin,'joueurs.php');
    }
});
</script>