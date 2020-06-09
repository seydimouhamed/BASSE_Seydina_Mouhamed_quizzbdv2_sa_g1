<style>
     tr
     {
         background-color:#C4C4C4;
         border:none;
        background-color:none;
     }

    table {
    border-collapse: separate;
    border-spacing: 0 0.5em;
    }
    tbody > tr:hover
    {
        background-color:#3C716D;
        color:white;
    }
    .bg-grey 
    {
        background-color:#C4C4C4;
    }
    .custom-control-input
    {
    }
    #scrollZone
    {
        max-height:250px;
    overflow: scroll;
    }
    </style>
<div class="container-fluid col-md-10 col-lg-10 col-sm-10 col-10  justify-content-center">

    
    <div class="h6 text-center ">Liste des joueurs</div>

    <div class="row bg-grey justify-content-around border-white border col-md-11 col-lg-11 col-sm-11 col-11 ">
        <span id="lock_user"><img src="./assets/images/icones/lock_open-24px.svg" alt="dqs"></span>
        <span id="unlock_user"><img src="./assets/images/icones/lock-24px.svg" alt="dqs"></span>
        <span id="deltete_user"><img src="./assets/images/icones/delete_sweep-24px.svg" alt="dqs"></span>
        <span id="rafresh_list"><img src="./assets/images/icones/refresh-24px.svg" alt="dqs"></span>
    </div>
    <div class="listejoueur col " id="scrollZone">
            <table class="table">
            <thead>
                <tr class="text-center">
                <th scope="col">
                    #
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck-0">
                        <label class="custom-control-label" for="customCheck-0"></label>
                    </div> -->
                </th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">score</th>
                </tr>
            </thead>
            <tbody id="tbody" >
            <td class="bg-danger">aucune utilisateurs à afficher</td>
            </tbody>
            </table>        
    <div>
</div>


    <script src="../assets/js/jquery.js"></script>



<script>
    $(document).ready(function(){
        //const date = $('#date').val();
        let offset = 0;
        const tbody = $('#tbody');
        $.ajax({
                type: "POST",
                url: "http://localhost/newquizzdb/data/utilisateurs.php?action=getAllPlayers",
                data: {limit:5,offset:offset},
                dataType: "JSON",
                success: function (data) {
                    tbody.html('')
                     console.log(data);
                     
                     printData(data,tbody);
                     offset +=5
                }
            });

            //  Scroll
        const scrollZone = $('#scrollZone')
        scrollZone.scroll(function(){
        //console.log(scrollZone[0].clientHeight)
        const st = scrollZone[0].scrollTop;
        const sh = scrollZone[0].scrollHeight;
        const ch = scrollZone[0].clientHeight;

        console.log(st,sh, ch);
        
        if(sh-st <= ch){
            $.ajax({
                type: "POST",
               // url: "http://localhost/newquizzdb/data/utilisateurs.php?action=getAllPlayers",
                url: "http://localhost/newquizzdb/data/utilisateurs.php?action=getAllPlayers",
                data: {limit:7,offset:offset},
                dataType: "JSON",
                success: function (data) {
                    
                   printData(data,tbody);
                   offset +=7;
                }
            });
        }
           
        })
    });

    // function printData(data,tbody){
    //     $.each(data, function(id,user){
    //         tbody.append(`
    //         <tr class="text-center">
    //             <td>
    //                 <div class="custom-control custom-checkbox">
    //                     <input type="checkbox" class="custom-control-input" id="id_${user.id}">
    //                     <label class="custom-control-label" for="id_${user.id}"></label>
    //                 </div>
    //             </td>
    //             <td>${user.firstname}</td>
    //             <td>${user.lastname}</td>
    //             <td>0</td>
    //         </tr>
    //     `);
    function printData(data,tbody){
        $.each(data, function(id,user){
            tbody.append(`
            <tr class="text-center">
                <td>
                   ${user.id}
                </td>
                <td>${user.firstname}</td>
                <td>${user.lastname}</td>
                <td>0</td>
                <td id="u_btn_${user.id}"><button class="btn btn-success" >change statut</button></td><td  id="s_btn_${id}"><button class="btn btn-danger">x</button></td>
            </tr>
        `);
        
    $("#tbody").on("click",".btn",function(){
        const tab = $(this).parents().attr("id").split("_");
        const id=tab[2];
        const type=tab[0];
        if(type =='u'){
           // if(confirm("Voulez vous modifier le statut de l'utilisateur !!")){
               //alert('id :'+id);
                const data={
                    "table":"utilisateurs",
                    "champ":"status",
                    "id":id,
                    "val":0
                }
               // $(this).parents("tr").hide()
               upStatutUser(data);
           // }
        }else if(type =='s'){
           // if(confirm("Voulez vous supprimer l'utilisateur !!")){
                const data={
                    "table":"utilisateurs",
                    "champ":"status",
                    "id":id,
                    "val":0
                }
                $(this).parents("tr").hide()
               deleteUser(data);
            //}
        }
    })

    const upStatutUser = (data) =>{
        $.ajax({
            method:"POST",
            url: "http://localhost/newquizzdb/data/utilisateurs.php?action=updateUserStatut",
            data:data
        })
        .done(data =>{
            console.log(data);
        })
    }

    const deleteUser = (data) =>{
        $.ajax({
            method:"POST",
            url: "http://localhost/newquizzdb/data/utilisateurs.php?action=deleteUser",
            data:data
        })
        .done(data =>{
            console.log(data);
        })
    }





            $('#lock_user').on('click',()=>
            {
                console.log('ok');
            })
    });


}
</script>