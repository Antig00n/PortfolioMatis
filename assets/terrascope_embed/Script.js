


window.onload=function(){
    const chk = document.getElementById('chk');

    chk.addEventListener('change', () => {
        document.body.classList.toggle('dark');
    });
  };


  const btn = document.querySelector(".checkbox");

const currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark1") {
  document.body.classList.add("dark-mode");
}

btn.addEventListener("click", function () {
  document.body.classList.toggle("dark-mode");

  let theme = "light";
  if (document.body.classList.contains("dark-mode")) {
    theme = "dark1";
  }
  localStorage.setItem("theme", theme);
 
});

