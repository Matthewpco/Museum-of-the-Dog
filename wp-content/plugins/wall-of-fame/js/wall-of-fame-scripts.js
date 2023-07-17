window.onload = function() {
    document.getElementById("wof_button").onclick = function() {
        document.getElementById("wof_modal").style.display = "block";
    };
    document.getElementById("wof_close").onclick = function() {
        document.getElementById("wof_modal").style.display = "none";
    };
};
