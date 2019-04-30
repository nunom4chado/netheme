//
//  OFFCANVAS TOGGLE
//––––––––––––––––––––––––––––––––––––––––––––––––––
/*
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
*/
//
//  OFFCANVAS MENU
//––––––––––––––––––––––––––––––––––––––––––––––––––
class OffcanvasMenu {
  constructor() {
    this.openButton = $("#icon-menu");
    this.closeButton = $("#icon-close");
    this.offcanvasMenu = $(".offcanvas");
    this.offcanvasOverlay = $(".offcanvas-overlay");
    // run events as soon object is created
    this.events();
  }

  // Events
  events() {
    this.openButton.on("click", this.openOffcanvas.bind(this));
    this.closeButton.on("click", this.closeOffcanvas.bind(this));
    this.offcanvasOverlay.on("click", this.closeOffcanvas.bind(this));
  }

  // Methods
  openOffcanvas() {
    this.offcanvasMenu.addClass("offcanvas--active");
    this.offcanvasOverlay.addClass("offcanvas-overlay--active");
  }

  closeOffcanvas() {
    this.offcanvasMenu.removeClass("offcanvas--active");
    this.offcanvasOverlay.removeClass("offcanvas-overlay--active");
  }
}

var neOffcanvasMenu = new OffcanvasMenu();

//
//  SEARCH
//––––––––––––––––––––––––––––––––––––––––––––––––––
class Search {
  constructor() {
    // addSearchHTML method needs to be first here so jquery can access the elements
    this.addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $("#icon-search");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.typingTimer;
    this.previousValue;
    this.events();
  }

  // Events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPress.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // Methods
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 650);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(
      neData.root_url + "/wp-json/ne/v1/search?term=" + this.searchField.val(),
      results => {
        this.resultsDiv.html(`
        <div class="search-overlay__results-inner">
          <div>
            <h2 class="search-overlay__section-title">Artigos</h2>
            ${
              results.artigos.length
                ? '<ul class="list-min">'
                : `<p class='search-overlay__no-results'>Sem resultados. <a href='${
                    neData.root_url
                  }/blog'>Ver todos os Artigos</a></p>`
            }
              ${results.artigos
                .map(
                  item =>
                    `<li><a href="${item.permalink}">${item.title}</a></li>`
                )
                .join("")}
            ${results.artigos.length ? "</ul>" : ""}
          </div>
          <div>
            <h2 class="search-overlay__section-title">Alimentos</h2>
            ${
              results.alimentos.length
                ? '<ul class="list-min">'
                : `<p class='search-overlay__no-results'>Sem resultados. <a href='${
                    neData.root_url
                  }/alimentos'>Ver todos os Alimentos</a></p>`
            }
              ${results.alimentos
                .map(
                  item =>
                    `<li><a href="${item.permalink}">${item.title}</a></li>`
                )
                .join("")}
            ${results.alimentos.length ? "</ul>" : ""}
          </div>
          <div>
            <h2 class="search-overlay__section-title">Nutrientes</h2>
            ${
              results.nutrientes.length
                ? '<ul class="list-min">'
                : `<p class='search-overlay__no-results'>Sem resultados. <a href='${
                    neData.root_url
                  }/nutrientes'>Ver todos os Nutrientes</a></p>`
            }
              ${results.nutrientes
                .map(
                  item =>
                    `<li><a href="${item.permalink}">${item.title}</a></li>`
                )
                .join("")}
            ${results.nutrientes.length ? "</ul>" : ""}
          </div>
        </div>
      `);
        this.isSpinnerVisible = false;
      }
    );
  }

  keyPress(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      !$("input, textarea").is(":focus")
    ) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    setTimeout(() => this.searchField.focus(), 301);
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    $("body").append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="search-overlay__inner">
            <i class="icon-magnifier search-overlay__icon" aria-hidden="true"></i>
            <input type="text" id="search-term" class="search-term" placeholder="O que procura?">
            <i class="icon-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        <div class="search-overlay__inner">
          <div id="search-overlay__results" class="search-overlay__results"></div>
        </div>
      </div>
    `);
  }
}

var neSearch = new Search();

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
