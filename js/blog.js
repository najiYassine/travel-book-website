const conteneurAvis = document.getElementById("conteneur-avis");
const avisdata = JSON.parse(localStorage.getItem("avisdata")) || [];

function collectdata() {
    const titleId = document.getElementById("titre").value;
    const textareaId = document.getElementById("avis").value;
    const avisObject = {
        titre: titleId,
        avis: textareaId
    };
    avisdata.push(avisObject);
    localStorage.setItem("avisdata", JSON.stringify(avisdata));
    afficherAvis();
}

function afficherAvis() {
    let txt = "";
    avisdata.forEach(function(item) {
        txt += `
            <div class="carte-avis">
                <h2>${item.titre}</h2>
                <p>${item.avis}</p>
            </div>
        `;
    });
    conteneurAvis.innerHTML = txt;
}
