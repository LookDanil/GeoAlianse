
var orders = document.querySelector(".orders");
var menu = document.querySelector(".menu");
var reports = document.querySelector(".reports");
var files = document.querySelector(".files");

function AddBlock(object,menu){
   object.classList.toggle('dispB');
   menu.classList.add('dispN');
}
function Back(object,menu){
    menu.classList.remove('dispN');
    object.classList.remove('dispB');
}
