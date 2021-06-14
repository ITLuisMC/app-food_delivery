//FUNCIÓN PARA COMPROBAR SI EL INPUT IMAGEN EXISTE Y DE SER ASI AÑADIR EVENTO A INPUT IMAGEN Y TRANSFORMAR IMAGEN A BASE64
function watchInputImg() {
    const fileInput = document.getElementById("imagen");

    if (fileInput != null) {

        fileInput.addEventListener("change", (e) => {

            const file = e.target.files[0];

            const reader = new FileReader();

            reader.onloadend = () => {

                const base64String = reader.result
                    .replace("data:", "")
                    .replace(/^.+,/, "");

                const fileOut = document.getElementById("logo");

                fileOut.value = base64String;

            };

            reader.readAsDataURL(file);

        });
    }
}

watchInputImg();