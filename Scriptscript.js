
//AUTO SLIDESHOW

let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 6000); // Change image every 6 seconds
}
    


 // SEARCH BAR FUNCTION 
 function mySearch() {
  // Declare variables 
  var input, filter, table, tr, i, j, column_length, count_td;
  column_length = document.getElementById('myTable').rows[0].cells.length;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) { // except first(heading) row
    count_td = 0;
    for(j = 1; j < column_length-1; j++){ // except first column
        td = tr[i].getElementsByTagName("td")[j];
        if (td) {
          if ( td.innerHTML.toUpperCase().indexOf(filter) > -1)  {            
            count_td++;
          }
        }
    }
    if(count_td > 0){
        tr[i].style.display = "";
    } else {
      tr[i].style.display = "None";
        
    }
  }
  
}



  