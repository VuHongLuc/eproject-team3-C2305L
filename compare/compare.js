var modal = document.querySelector('.modal');
var btnCompare = document.querySelectorAll('.compareButton');
var numberCompare = document.getElementById('numberCompare');


if (numberCompare.innerHTML == 3){
    btnCompare.forEach(element => {
        element.addEventListener("click", function(event){
            event.preventDefault();
        })
    });
    modal.id = "notifyCompare";

}
else {
    btnCompare.forEach(element => {
        element.removeEventListener("click", function(event){
            event.preventDefault();

        })
    });
    modal.id = "";
}



          
