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
                    `
                    <li class="ne-recent-post-item">
                        <a href="${item.permalink}">
                            <img src="${item.image}" alt="${item.title}">
                        </a>
                        <div class="ne-recent-post-item__details">
                            <a class="ne-recent-post-item__title-link" href="${
                              item.permalink
                            }">
                                <h4 class="ne-recent-post-item__title">${
                                  item.title
                                }</h4>
                            </a>
                            <p class="ne-recent-post-item__date">${
                              item.date
                            }</p>
                        </div>
                    </li>

                    `
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
                    `
                    <li class="ne-recent-post-item valign-center">
                        <a href="${item.permalink}">
                            <img src="${item.image}" alt="${item.title}">
                        </a>
                        <div class="ne-recent-post-item__details">
                            <a class="ne-recent-post-item__title-link" href="${
                              item.permalink
                            }">
                                <h4 class="ne-recent-post-item__title">${
                                  item.title
                                }</h4>
                            </a>
                            <p class="ne-recent-post-item__date">${"category"}</p>
                        </div>
                    </li>
                    `
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
                    `
                    <li class="ne-recent-post-item valign-center">
                        <a href="${item.permalink}">
                            <img src="${item.image}" alt="${item.title}">
                        </a>
                        <div class="ne-recent-post-item__details">
                            <a class="ne-recent-post-item__title-link" href="${
                              item.permalink
                            }">
                                <h4 class="ne-recent-post-item__title">${
                                  item.title
                                }</h4>
                            </a>
                            <p class="ne-recent-post-item__date">${"category"}</p>
                        </div>
                    </li>
                    `
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
// get values from nutrition table
let ntHc = $("#ne-nt-hc").data('value');
let ntLip = $("#ne-nt-lip").data('value');
let ntProt = $("#ne-nt-prot").data('value');

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
      colors: ["#D7B084", "#D74562", "#D784A6"],
      chartArea: {
        left: "3%",
        top: "3%",
        height: "82%",
        width: "94%"
      }
    };

    var data = google.visualization.arrayToDataTable([
      ["Distribuição Nutricional", "em Percentagem"],
      ["Hidratos de Carbono", ntHc],
      ["Lípidos", ntLip],
      ["Proteína", ntProt]
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

// Rounding function
function round(value, decimals) {
  return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

//
// NUTRITION TABLE UPDATE VALUES AND DDR
//––––––––––––––––––––––––––––––––––––––––––––––––––
class RecalcValues {
  constructor() {
    this.inputField = $("#change-grams");
    this.basedValues = $("#grams-based-val");
    this.elements = $('.ne-nutrition-table .ne-nutrition-table__element');
    
    //Define Base DDR values
    this.ddr = {
      "calorias": 2000,
      "hc": 5,
      "lp": 3,
      "pt": 4
    }
    
    // Init Events
    this.events();
  }
  
  events() {
    $(window).on("load", this.setDDR.bind(this));
    this.inputField.on("keyup mouseup", this.updateValues.bind(this));
  }
  
  // methods
  calculateDDR(nutriVal, nutriBaseDDR) {
    return Math.round((100 * nutriVal) / nutriBaseDDR);
  }
  
  setDDR() {
    // Reference Class Scoup to access within each function
    var classReference = this;
    
    this.elements.each(function() {
      var DDRtype = $(this).data('name');
      var nutriValue = $(this).data('value');
      var currentBaseDDR = classReference.ddr[DDRtype];
      // check if ddr is aplicable
      if (currentBaseDDR) {
        var calculatedDDR = classReference.calculateDDR(nutriValue, currentBaseDDR);
        //console.log(calculatedDDR);
        $(this).find(".ne-nutrition-table__element-ddr").text(calculatedDDR + "%");
      }
    });
  }
  
  updateValues() {
    var inputVal = this.inputField.val();
    
    // If input is empty set default to 100
    if (inputVal == "") {
      inputVal = 100;
    }
    
    // Update description "Values based on"
    this.basedValues.text(inputVal);

    // Reference Class Scoup to access within each function
    var classReference = this;
    
    this.elements.each(function(){
      var updatedValue = $(this).data('value') * inputVal / 100;
      $(this).find(".ne-nutrition-table__element-quantity").text(round(updatedValue, 1));
       
      var DDRtype = $(this).data('name');
      var currentBaseDDR = classReference.ddr[DDRtype];
      // check if ddr is aplicable
      if (currentBaseDDR) {
        var calculatedDDR = classReference.calculateDDR(updatedValue, currentBaseDDR);
        //console.log(calculatedDDR);
        $(this).find(".ne-nutrition-table__element-ddr").text(calculatedDDR + "%");
      }
    });
  }
}

var recalcValues = new RecalcValues();

//
// Collapse all Nutrition Tabs
//––––––––––––––––––––––––––––––––––––––––––––––––––
class CollapseNT {
  constructor() {
    this.closeAllBtn = $("#close-ntable-btn");
    // run events as soon object is created
    this.events();
  }

  // Events
  events() {
    this.closeAllBtn.on("click", this.closeAll.bind(this));
  }

  // Methods
  closeAll() {
    var cbarray = document.getElementsByName('ne-nt-input');
    for(var i = 0; i < cbarray.length; i++){

            cbarray[i].checked = false;
    }
  }
}

var collapseNT = new CollapseNT();