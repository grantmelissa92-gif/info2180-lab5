document.addEventListener("DOMContentLoaded", function(){
    const button = document.getElementById("lookup");
    const results = document.getElementById("result");

    button.addEventListener("click", function(){
        const country = document.getElementById("country").value;

        fetch(`world.php?country=${country}`)
        .then(response => response.text())
        .then(data => {
            results.innerHTML = data;
        })
        .catch(error => {
            results.innerHTML = "An error occured.";
        });
    });

});