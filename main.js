const search = document.getElementById('search');

window.onload = ()=>{
    search.focus();
}

const regx = RegExp('name', 'ig')

search.onkeyup = (e)=>{
    e.preventDefault();
    const val = e.target.value;
    if(regx.test(val)){
        console.log("Found Match")
    }
}