<div class="container col-md-6 col-sm-9 col-10 justify-content-center  "> 
           
          <br>
          <div class="h4 text-center  ">Connexion</div>
        <br>

        <form id="mainform" action="Javascript:void(0);">
          <div class="row rowip">
            <div class="labip col-md-3  col-lg-3 col-sm-3 col-3">Login</div>
            <div class="quadip "></div>
            <div class="ipd ">
                <input type="text" error="error-log" name="login" id="login" class="form-control ip"/>
            </div>
         </div>
        <small id="error-log" class="error text-danger pull-right">
        </small>
        <br>
         <div class="row rowip">
            <div class="labip col-md-3 col-lg-3 col-sm-3 col-3">Password </div>
            <div class="quadip"></div>
            <div class="ipd ">
                <input type="password" name="pwd" error='error-pwd' class="form-control ip" id="pwd" />
          </div> 
        </div>
        <small id="error-pwd" class="error text-danger "></small>
        <br>
        <div class="row">
            <button type="submit" id="connexion" name="connexion" value='connexion' class="form-control ubtn">Connexion</button>
        </div>
        <div class="text-center"><small>OU</small></div>
        <div class="row">
            <button  value='inscription' id="inscription" class="form-control ubtn nav-link" >Inscription</button>
        </div>
      </div>
      </form>

</div>
<script>

    $('#connexion').click(function(){
        form=$('#mainform');
        // const donne=new FormData(form);
         const log = $('#login').val();
         const pwd = $('#pwd').val();
        // console.log($('form').serialize());
        if(log == '' || pwd ==''){
            return false;
        }

        $.ajax({

                type: "POST",
                url: "http://localhost/newquizzdb/data/utilisateurs.php?action=connexion",
                //data: $('form').serialize(),
                data: {"login":log,"pwd":pwd},
               // data:donne
                dataType: "JSON",
                success: function (data) {
                   if(data){
                       if(data['msg']['type']=='success')
                       {

                            $('#nav').load('./pages/navbar2.php'); 
                            console.log(data);

                            if(data['info_user']['profil']==="admin")
                            {
                                $('#container').load('./pages/accueil.php'); 
                            }else 
                            {
                                $('#container').load('./pages/jeux.php'); 
                            }
                       }
                       else
                       {

                            console.log(data);
                           alert(''+data['msg']['text'])
                       }
                       //$('#container').load('pages/table',{date:1}); 
                      /* 
                      OU BIEN
                      $('#tbody').append(`
                        <tr class="text-center">
                            <td>nouvelleHeure</td>
                            <td>nouveauTel</td>
                            <td>nouveauMont</td>
                        </tr>
                    `)*/
                   }
                }
            });
    })

    $('#inscription').click(function(){
        const container = $('#container');
        container.load(`pages/inscription.php`,function(response, status,detail){        
         if(status === 'error'){
            $("#container").html(`<p class="text-center alert alert-danger col">Le contenu demandé est introuvable!</p>`);
            //ou bien
            //$("#table").html(`<p class="text-center alert alert-danger col">Code Erreur : ${detail.status}, ${detail.statusText}</p>`);
        }
    });
    })
</script>