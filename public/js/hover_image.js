const copyBtn = document.getElementById("labelFile");

const resultContainer = document.querySelector(".result");

resultContainer.addEventListener("mousemove", e => {
    resultContainerBound = {
        left: resultContainer.getBoundingClientRect().left,
        top: resultContainer.getBoundingClientRect().top,
    };
        copyBtn.style.opacity = '1';
        copyBtn.style.pointerEvents = 'all';
        copyBtn.style.setProperty("--x", `${e.x - resultContainerBound.left}px`);
        copyBtn.style.setProperty("--y", `${e.y - resultContainerBound.top}px`);

});

var output = document.getElementById('output');
var file = document.getElementById('file');

file.onchange = function() {
  var url = URL.createObjectURL(this.files[0]);
  console.log("url",url);
  output.src= url;
}

// var loadFile = function(event) {
//   var url =  URL.createObjectURL(event.target.files[0]);
//   console.log(url);
//
//
// };

// function output(a) {
//   output.style.backgroundImage = "url("+ a.value +")";
// }
