$(function(){
    let nb=4;
    const getDonneesAPI=(n) =>
    {
        $.ajax({
                method:'GET',
                url:`https://rzndomuser.me/api/?results=${n}`
        })
        .done(data=>{
            console.log(data)
        })
    }

    //----------------------------------------
    const objUser=(datas)=>{
        let usrs=[];
        for(let data of datas)
        {
            console.log(data);
        }
    }
    getDonneesAPI(nb);
})