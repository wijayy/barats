$(document).ready(function () {
  const body = document.querySelector("body"),
    nav = document.querySelector("nav"),
    modeToggle = document.querySelector(".dark-light"),
    searchToggle = document.querySelector(".searchToggle"),
    sidebarOpen = document.querySelector(".sidebarOpen"),
    siderbarClose = document.querySelector(".siderbarClose");

  let getMode = localStorage.getItem("mode");
  if (getMode && getMode === "dark-mode") {
    body.classList.add("dark");
  }

  // js code to toggle dark and light mode
  modeToggle.addEventListener("click", () => {
    modeToggle.classList.toggle("active");
    body.classList.toggle("dark");

    // js code to keep user selected mode even page refresh or file reopen
    if (!body.classList.contains("dark")) {
      localStorage.setItem("mode", "light-mode");
    } else {
      localStorage.setItem("mode", "dark-mode");
    }
  });

  // js code to toggle search box
  searchToggle.addEventListener("click", () => {
    searchToggle.classList.toggle("active");
  });

  //   js code to toggle sidebar
  sidebarOpen.addEventListener("click", () => {
    nav.classList.add("active");
  });

  body.addEventListener("click", (e) => {
    let clickedElm = e.target;

    if (
      !clickedElm.classList.contains("sidebarOpen") &&
      !clickedElm.classList.contains("menu")
    ) {
      nav.classList.remove("active");
    }
  });

  $.post(
    "../assets/window.php",
    { width: screen.width, height: screen.height },
    function (json) {
      if (json.outcome == "success") {
        console.log(screen.width);
        console.log(screen.height);
      } else {
        alert("Unable to let PHP know what the screen resolution is!");
      }
    },
    "json"
  );

  $("#loader").hide();

  // event ketika keyword ditulis
  $("#keyword").on("keyup", () => {
    // $.get()

    $("#loader").show();
    $("#search").hide();

    $.get(
      "../assets/search.php?keyword=" + $("#keyword").val(),
      function (data) {
        $(".search-section").html(data);

        $("#loader").hide();
        $("#search").show();
      }
    );
  });
});
