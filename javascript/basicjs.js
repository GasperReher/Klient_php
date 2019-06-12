
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "0px 5px";

  } else {
    document.getElementById("navbar").style.padding = "15px 10px";

  }
}
