document.addEventListener("DOMContentLoaded", function(){
    
    const lookUp = document.getElementById("lookup");
    const citieslookup = document.getElementById("citieslookup");

    function searchCountry(lookUptype) {

        const httpRequest = new XMLHttpRequest();
        const country = document.getElementById('country').value;
        
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    document.getElementById("result").innerHTML = httpRequest.responseText;
                }else {
                    document.getElementById("result").innerHTML = "There was an error."
                }
            }
        };
        let url = "world.php?country=" + encodeURIComponent(country);
        if (lookUptype === "cities") {
            url += "&lookup=cities";
        }
        
        httpRequest.open("GET", url);
        httpRequest.send();
    }
    lookUp.addEventListener("click", function() {
        searchCountry("country");
    });
    citieslookup.addEventListener("click", function(){
        searchCountry("cities");
    });
});