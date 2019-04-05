//
//  OFFCANVAS TOGGLE
//––––––––––––––––––––––––––––––––––––––––––––––––––

document
  .getElementById("icon-menu")
  .addEventListener("click", displayOffcanvas);

document
  .querySelector(".offcanvas-overlay")
  .addEventListener("click", displayOffcanvas);

document
  .querySelector("#icon-close")
  .addEventListener("click", displayOffcanvas);

function displayOffcanvas() {
  document
    .querySelector(".offcanvas-overlay")
    .classList.toggle("offcanvas-overlay--active");
  document.querySelector(".offcanvas").classList.toggle("offcanvas--active");
}

// Fancybox - Force all link tags that links to an img to open on lighbox
jQuery(function($) {
  $(
    'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]'
  ).fancybox({});
});
