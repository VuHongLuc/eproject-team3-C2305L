var modal = document.querySelector('.modal');
var btnCompare = document.querySelectorAll('.compareButton');
var numberCompare = document.getElementById('numberCompare');

// if (numberCompare.innerHTML >= 3){
//     modal.id = "notifyCompare";
// }else {
//     modal.id = "";

// }

if (numberCompare.innerHTML == 3){
    modal.id = "notifyCompare";
    btnCompare.forEach(element => {
        element.addEventListener("click", function(event){
            event.preventDefault();
        })
    });
}
else {
    modal.id = "";
    btnCompare.forEach(element => {
        element.removeEventListener("click", function(event){
            event.preventDefault();
        })
    });
};



          
