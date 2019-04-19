function openCategory(categoryName) {
    var i;
    var x = document.getElementsByClassName("category");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
    }
    document.getElementById(categoryName).style.display = "block";
    document.getElementById(categoryName + '-title').style.display = "block";
    load_products(categoryName)
}
function load_products(categoryName) {
    document.getElementById(categoryName).innerHTML='<object type="text/html" data="static/products.html" ></object>';
}
function openForm(id) {
    document.getElementById(id).style.display = "block";
}

function closeForm(id) {
    document.getElementById(id).style.display = "none";
}

