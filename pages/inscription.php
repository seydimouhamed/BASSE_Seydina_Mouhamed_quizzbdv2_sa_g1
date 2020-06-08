  <style>

.rowimg{
position: relative;
left: -10px;
width: 50%;
height:70px;
/* background: #3C716D; */
border: 2px solid #FFFFFF;
box-sizing: border-box;
box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.btn_img
{
    background: #3C716D;
    color:white;
    height:50px;

}

.ic
{
    float:right;
    width:40px;
    height:40px;
}

.lab_ph
{
    line-height:2.5em;
    font-weight:bold;
}
.img
{
    position:relative;
    top:-25px;
    left:-10px;
    width:120px;
    height:120px;
}
</style>
<div class="container col-md-6 col-sm-9 col-10 justify-content-center  "> 
          <div class="h4 text-center  ">Inscription</div>
        
        <form id="form_register" action="Javascript:void(0);" enctype="multipart/form-data">
          <div class="row rowip">
            <div class="labip  col-md-3  col-lg-3 col-sm-3 col-3">Prenom</div>
            <div class="quadip "></div>
            <div class="ipd ">
                <input type="text" error="error-fn" name="firstname" id="prenom" class="form-control ip"/>
            </div>
         </div>
        <small id="error-fn" class="error text-danger pull-right">
        </small>
        <br>
          <div class="row rowip">
            <div class="labip  col-md-3  col-lg-3 col-sm-3 col-3">Nom</div>
            <div class="quadip "></div>
            <div class="ipd ">
                <input type="text" error="error-ln" name="lastname" id="nom" class="form-control ip"/>
            </div>
         </div>
        <small id="error-ln" class="error text-danger pull-right">
        </small>
        <br>
          <div class="row rowip">
            <div class="labip  col-md-3  col-lg-3 col-sm-3 col-3">Login</div>
            <div class="quadip "></div>
            <div class="ipd ">
                <input type="text" error="error-log" name="login" id="login" class="form-control ip"/>
            </div>
         </div>
        <small id="error-log" class="error text-danger pull-right">
        </small>
        <br>
         <div class="row rowip">
            <div class="labip  col-md-3  col-lg-3 col-sm-3 col-3">Password</div>
            <div class="quadip"></div>
            <div class="ipd ">
                <input type="password" name="pwd" error='error-pwd' class="form-control ip" id="pwd" />
          </div>
        </div>
        <small id="error-pwd" class="error text-danger "></small>
        <br>
         <div class="row rowip">
            <div class="labip  col-md-3  col-lg-3 col-sm-3 col-3 small"> C.password</div>
            <div class="quadip"></div>
            <div class="ipd ">
                <input type="password" name="cpwd" error='error-cpwd' class="form-control ip" id="cpwd" />
          </div>
        </div>
        <small id="error-cpwd" class="error text-danger "></small>
        <br>
        <br>
        <div class="row">
            <div class="rowimg py-2 px-3">
                <div class="btn_img form-control font-weigth-bold rounded-lg"><label class="col-sm-12 col-md-12" for="avatar"> <span class="lab_ph">Choisir</span><span> <img class="ic " src="./assets/images/icones/add_a_photo-24px.svg" alt=""/></span><input type="file" id="avatar" name="avatar" onchange="prevUpload(); " class="form-control invisible"> </label></div> 
                <!-- <input type="file" id="avatar"  class="form-control"> -->
            </div>
                <img class="rounded-circle img-fluid img border-white border" id="photo" src="./assets/images/photos/giraffe.png" alt=""/>
            
        </div>
        <br>
        <div class="row">
            <button type="submit" value='inscription' id="inscription" name="inscription" class="form-control ubtn">S'Inscription</button>
        </div>
      </div>
      </form>
      </div>

      <script>

    $('#form_register').on('submit',function(){
       //var form=$('#form_register');
      // var form=document.getElementById('form_register');
        //var donne= form.serialize()

       //console.log(form);
        
        var donne=new FormData($('#form_register')[0]);
      // console.log(donne);
        //  const log = $('#login').val();
        //  const pwd = $('#pwd').val();
        // console.log($('form').serialize());
        // if(log == '' || pwd ==''){
        //     return false;
        // }
  
        $.ajax({

                type: "POST",
                url: "http://localhost/newquizzdb/data/utilisateurs.php?action=inscription",
                //data: $('form').serialize(),
                data: donne,
                processData: false,
                contentType:false,
               // data:donne
                dataType: "JSON",
                success: function (data) {
                   if(data){
                       if(data['msg']['type']=='success')
                       {
                           console.log(data);
                           alert(" le nom de l'image "+data['file_name'])

                            $('#nav').load('./pages/navbar2.php'); 

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
                           alert(''+data['msg']['text']);
                       }
                   }
                }
            });
    })

    // $('#inscription').click(function(){
    //     const container = $('#container');
    //     container.load(`pages/inscription.php`,function(response, status,detail){        
    //      if(status === 'error'){
    //         $("#container").html(`<p class="text-center alert alert-danger col">Le contenu demandé est introuvable!</p>`);
    //         //ou bien
    //         //$("#table").html(`<p class="text-center alert alert-danger col">Code Erreur : ${detail.status}, ${detail.statusText}</p>`);
    //     }
    // });
    // })
</script>