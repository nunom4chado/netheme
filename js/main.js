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

// Google Chart for Alimento Page
google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Distribuição Nutricional", "em Percentagem"],
    ["Hidratos de Carbono", 11],
    ["Lípidos", 2],
    ["Proteína", 2]
  ]);

  var options = {
    pieHole: 0.4,
    width: "100%",
    height: "100%",
    chartArea: {
      left: "3%",
      top: "3%",
      height: "94%",
      width: "94%"
    },
    legend: {
      position: "right",
      maxLines: 3
    }
  };

  var chart = new google.visualization.PieChart(
    document.getElementById("ne-nutrition-distribution")
  );
  chart.draw(data, options);
}
