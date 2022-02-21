$(".tab-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "To post"
    }
    , onFinished: function (event, currentIndex) {
       document.getElementById("form").click();
    }
});
