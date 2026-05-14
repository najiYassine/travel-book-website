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
    avisdata.forEach(function(item, index) {
        txt += `
            <div class="carte-avis">
                <div class="content">
                    <div class="carte-header">
                        <h2>${item.titre}</h2>
                        <button class="btn-delete" onclick="supprimerAvis(${index})">Supprimer</button>
                    </div>
                    <p>${item.avis}</p>
                </div>
            </div>
        `;
    });
    conteneurAvis.innerHTML = txt;
}

function supprimerAvis(index) {
    avisdata.splice(index, 1);
    localStorage.setItem("avisdata", JSON.stringify(avisdata));
    afficherAvis();
}
