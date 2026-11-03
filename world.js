document.addEventListener("DOMContentLoaded", fucntion(){
    const lookUp = document.getElementById("lookup");
    lookUp.addEventListener("click", function() {
        const httpRequest = new XMLHttpRequest();
        const country = document.getElementById('country').value;
        
        httpRequest.onreadystatechange = function(){
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    document.getElementById("result").innerHTML = httpRequest.responseText;
                }
            }
        };
        httpRequest.open("GET", "world.php?country=" + encodeURIComponent(country));
        httpRequest.send();
    });
});