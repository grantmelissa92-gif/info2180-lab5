document.addEventListener("DOMContentLoaded", function(){
    const results = document.getElementById("result");

    //Lookup Country
    const lookup_countybtn = document.getElementById("lookupCountry");
    lookup_countybtn.addEventListener("click", function(){
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

    //Lookup Cities
    const lookup_citiesbtn = document.getElementById("lookupCities");
    lookup_citiesbtn.addEventListener("click", function(){
        const country = document.getElementById("country").value;

        fetch(`world.php?country=${country}&lookup=cities`)
        .then(response => response.text())
        .then(data => {
            results.innerHTML = data;
        })
        .catch(error => {
            results.innerHTML = "An error occured.";
        });
    });

});