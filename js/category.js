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
function addSubcategoryField(id) {
    var child = document.getElementsByClassName("sublist-container")[0].cloneNode(true);
    document.getElementById(id).appendChild(child);
}
function removeSubcategoryField(element) {
    var parent = element.parentNode
    parent.parentNode.removeChild(parent);
}
