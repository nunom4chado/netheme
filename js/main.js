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

//
//  SEARCH
//––––––––––––––––––––––––––––––––––––––––––––––––––
class Search {
  constructor() {
    this.openButton = $("#icon-search");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.events();
  }

  // Events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
  }

  // Methods
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
  }
}

var neSearch = new Search();

//
// Fancybox - Force all link tags that links to an img to open on lighbox
//––––––––––––––––––––––––––––––––––––––––––––––––––
/*jQuery(function($) {
  $(
    'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]'
  ).fancybox({});
});*/

//
// Google Chart for Alimento Page
//––––––––––––––––––––––––––––––––––––––––––––––––––
var neFoodChart = document.getElementById("ne-food-chart");

if (neFoodChart) {
  google.load("visualization", "1", {
    packages: ["corechart"]
  });
  google.setOnLoadCallback(initChart);

  jQuery(function($) {
    $(window).on("throttledresize", function(event) {
      initChart();
    });
  });

  function initChart() {
    var options = {
      pieHole: 0.4,
      legend: { position: "bottom", textStyle: { fontSize: 12 } },
      width: "100%",
      height: "80%",
      pieSliceText: "percentage",
      colors: ["#0598d8", "#f97263", "#773521"],
      chartArea: {
        left: "3%",
        top: "3%",
        height: "82%",
        width: "94%"
      }
    };

    var data = google.visualization.arrayToDataTable([
      ["Distribuição Nutricional", "em Percentagem"],
      ["Hidratos de Carbono", 11],
      ["Lípidos", 2],
      ["Proteína", 2]
    ]);
    drawChart(data, options);
  }

  function drawChart(data, options) {
    var chart = new google.visualization.PieChart(
      document.getElementById("ne-food-chart")
    );
    chart.draw(data, options);
  }
}
