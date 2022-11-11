const velocity = 2;
const timeSLeep = 10;
function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

const text = document.querySelectorAll(".text span");
const text1 = document.querySelector(".text1");
async function localText() {
  for (let i = 0; i < text.length; i++) {
    var posX = Math.floor(Math.random() * 80) + 10;
    var posY = Math.floor(Math.random() * 80) + 10;
    text[i].style = "visibility: visible";
    text[i].style.top = posX + "%";
    text[i].style.left = posY + "%";

    await sleep(300);
  }
  move(text, text1);
}

localText();

async function move(text, text1) {
  for (let i = 0; i < text.length; i++) {
    var x = Math.floor(text[i].style.left.replace("%", ""));
    var y = Math.floor(text[i].style.top.replace("%", ""));

    var x1 = 50;
    var y1 = 50;
    while (x !== x1 || y !== y1) {
      if (x > x1) x -= velocity;
      if (x < x1) x += velocity;
      if (y > y1) y -= velocity;
      if (y < y1) y += velocity;
      if (Math.abs(x - x1) < velocity) x = x1;
      if (Math.abs(y - y1) < velocity) y = y1;
      text[i].style.left = x + "%";
      text[i].style.top = y + "%";
      if (x === x1 && y === y1) {
        text[i].style.display = "none";
        text1.innerHTML += text[i].innerHTML;
      }
      await sleep(timeSLeep);
    }
  }
}
