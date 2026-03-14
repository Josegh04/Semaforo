// imagen.js
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.createElement('div');
    modal.id = "modal-img";
    modal.style.display = "none";
    modal.style.position = "fixed";
    modal.style.top = 0;
    modal.style.left = 0;
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.background = "rgba(0,0,0,0.8)";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.zIndex = 1000;
    modal.style.cursor = "pointer";

    const img = document.createElement('img');
    img.style.maxWidth = "90%";
    img.style.maxHeight = "90%";
    img.style.borderRadius = "12px";
    modal.appendChild(img);

    document.body.appendChild(modal);

    document.querySelectorAll('.thumb img').forEach(el => {
        el.style.cursor = "pointer";
        el.addEventListener('click', function () {
            img.src = this.src;
            modal.style.display = "flex";
        });
    });

    modal.addEventListener('click', function () {
        modal.style.display = "none";
    });
});