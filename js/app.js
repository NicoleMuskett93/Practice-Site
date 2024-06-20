(() => {
  // resources/js/app.js
  window.addEventListener("load", function() {
    let main_navigation = document.querySelector("#primary-menu");
    let mobile_navigation = document.querySelector("#mobile-pop-out");
    let content = document.querySelector("#content");
    document.querySelector("#primary-menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      mobile_navigation.classList.toggle("hidden");
      content.classList.add("black");
    });
    let searchtoggle = document.querySelector(".search-toggle");
    let searchbar = document.querySelector("#search-form");
    let searchclose = document.querySelector("#search-close");
    let mobilesearchclose = document.querySelector(".search-close");
    searchtoggle.addEventListener("click", function(e) {
      searchbar.classList.toggle("hidden");
      searchbar.classList.add("translate-x-0");
    });
    searchclose.addEventListener("click", function(e) {
      searchbar.classList.add("hidden");
    });
    mobilesearchclose.addEventListener("click", function(e) {
      mobile_navigation.classList.add("hidden");
    });
  });
})();
