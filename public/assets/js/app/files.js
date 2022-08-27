$(() => {

        $('#start').click(() =>{
            $('#cont').hide('slow');
            $('#form_view').show('slow');
        }); 

        $('#step1').click(() => {

            if($('#entrepreneur').val() == '' || $('#titre_projet').val() == '' || $('#contact').val() == '' || $('#profession').val() == '' || $('#date_lancement').val() == ''){
                $('#z_notification').html('<div style="color:red;">un ou plusieurs champs de ces quatres champs sont vides</div>');
                if($('#entrepreneur').val() == '') $('#entrepreneur').css('border','1px solid red'); else $('#entrepreneur').css('border','1px solid green');
                if($('#titre_projet').val() == '') $('#titre_projet').css('border','1px solid red'); else $('#titre_projet').css('border','1px solid green');
                if($('#contact').val() == '') $('#contact').css('border','1px solid red'); else $('#contact').css('border','1px solid green');
                if($('#profession').val() == '') $('#profession').css('border','1px solid red'); else $('#profession').css('border','1px solid green');
                if($('#dl').val() == '') $('#dl').css('border','1px solid red'); else $('#dl').css('border','1px solid green');
                
            }else{
            
            let datas = new FormData($('#form')[0]);
            fetch(""+$('#start_step1').val()+"",{
                method: "post",
                body: datas
            }).then(async (response)=>{
                 
                let contentType = response.headers.get("content-type");
                if(contentType && contentType.indexOf("application/json") !== -1){
                                                                         
                    const json = await response.json(); // reponse js 
                    
                   json.map((n)=>{
                    
                    if(n.code == 200){
                        
                        return location.href = $('#next').val() + '?id=' + n.id;
                    }

                    if(n.code == 300){
                        $('#z_notification').html(n.msg).css('color','red');
                    }
                       
                   });
                   
                }else{
    
                   alert('Erreur sur le serveur');
                }
            });

                
           }

        })

})