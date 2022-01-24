$(function(){
    $(".navbar a, footer a").on("click", function(event){
        event.preventDefault();
        var hash = this.hash;
        
        $("body,html").animate({scrollTop: $(hash).offset().top}, 900 , function(){window.location.hash = hash;})
    });
    
    
     $('#contact-form').submit(function(e){
        
        e.preventDefault();
        $('.comment').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(result) {
                
                if(result.isSuccess)
                {
                  
                    $("#contact-form").append("<p class ='thank-you'>Votre message à bien été envoyé !</p>");
                    $("#contact-form")[0].reset();   
                }
                else
                { 
                    $("#firstname + .comment").html(result.firstnameError);
                    $("#name + .comment").html(result.nameError);
                    $("#email + .comment").html(result.emailError);
                    $("#message + .comment").html(result.messageError);
                    $("#phone + .comment").html(result.phoneError);
                }
                
            }
            
        });
        
    });
})