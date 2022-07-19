
var Keka = document.querySelectorAll('.Keka');

function Kek(event){
   var refuse_id = event.target.id;
   var Keka1 = Keka[refuse_id-1];
   if(Keka1.style.display == "none"){
            Keka1.style.display = "block";
         }
         else{
            Keka1.style.display = "none";
         }
}