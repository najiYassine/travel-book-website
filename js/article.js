const voyage = JSON.parse(localStorage.getItem("voyages"));

const volAllerSimple = document.getElementById("vol-aller-simple");
const volAllerRetour = document.getElementById("vol-aller-retour");
const volMultiDestinations = document.getElementById("vol-multi-destinations");

const classeEconomique = document.getElementById("classe-economique");
const classeBusiness = document.getElementById("classe-business");
const classePremiere = document.getElementById("classe-premiere");

const prixMinimum = document.getElementById("prix-minimum");
const prixMaximum = document.getElementById("prix-maximum");

const evaluation5Etoiles = document.getElementById("evaluation-5-etoiles");
const evaluation4Etoiles = document.getElementById("evaluation-4-etoiles");
const evaluation3Etoiles = document.getElementById("evaluation-3-etoiles");

const hotelInclus = document.getElementById("hotel-inclus");
const hotelSans = document.getElementById("hotel-sans");
const hotelPetitDejeuner = document.getElementById("hotel-petit-dejeuner");

const continentEurope = document.getElementById("continent-europe");
const continentAsie = document.getElementById("continent-asie");
const continentAfrique = document.getElementById("continent-afrique");
const continentAmerique = document.getElementById("continent-amerique");
const continentOceanie = document.getElementById("continent-oceanie");

const offreReduction = document.getElementById("offre-reduction");
const offreSansReduction = document.getElementById("offre-sans-reduction");

const section = document.getElementById("section");

function afficherVoyages(data) {
    let txt = "";
    data.forEach(function (prod) {
        txt += `
      <div class="carte-voyage">
        <img src="${prod.picture}" loading="lazy" alt="${prod.destination}" />
        <div class="corps">
          <p class="destination">${prod.destination}</p>
          <p class="prix">
            ${prod.prix} MAD
          </p>
          <span class="badge-classe">
            ${prod.classe}
          </span>
          <button class="btn-confirmer" onclick="reserve(${prod.id})">
            Réserver
          </button>
        </div>
      </div>
    `;
    });

    section.innerHTML = txt;
}

afficherVoyages(voyage);

function filtrerVoyages() {

    const resultat = voyage.filter(function (prod) {

        if (
            volAllerSimple.checked &&
            prod.typeVol !== "Aller simple"
        ) {
            return false;
        }

        if (
            volAllerRetour.checked &&
            prod.typeVol !== "Aller-retour"
        ) {
            return false;
        }

        if (
            volMultiDestinations.checked &&
            prod.typeVol !== "Multi-destinations"
        ) {
            return false;
        }

        if (
            classeEconomique.checked &&
            prod.classe !== "Économique"
        ) {
            return false;
        }

        if (
            classeBusiness.checked &&
            prod.classe !== "Business"
        ) {
            return false;
        }

        if (
            classePremiere.checked &&
            prod.classe !== "Première classe"
        ) {
            return false;
        }

        if (
            prixMinimum.value &&
            prod.prix < Number(prixMinimum.value)
        ) {
            return false;
        }

        if (
            prixMaximum.value &&
            prod.prix > Number(prixMaximum.value)
        ) {
            return false;
        }

        if (
            evaluation5Etoiles.checked &&
            prod.evaluation !== 5
        ) {
            return false;
        }

        if (
            evaluation4Etoiles.checked &&
            prod.evaluation !== 4
        ) {
            return false;
        }

        if (
            evaluation3Etoiles.checked &&
            prod.evaluation !== 3
        ) {
            return false;
        }

        if (
            hotelInclus.checked &&
            prod.hotel !== true
        ) {
            return false;
        }

        if (
            hotelSans.checked &&
            prod.hotel !== false
        ) {
            return false;
        }

        if (
            hotelPetitDejeuner.checked &&
            prod.petitDejeuner !== true
        ) {
            return false;
        }

        if (
            continentEurope.checked &&
            prod.continent !== "Europe"
        ) {
            return false;
        }

        if (
            continentAsie.checked &&
            prod.continent !== "Asie"
        ) {
            return false;
        }

        if (
            continentAfrique.checked &&
            prod.continent !== "Afrique"
        ) {
            return false;
        }

        if (
            continentAmerique.checked &&
            prod.continent !== "Amérique"
        ) {
            return false;
        }

        if (
            continentOceanie.checked &&
            prod.continent !== "Océanie"
        ) {
            return false;
        }

        if (
            offreReduction.checked &&
            prod.reduction !== true
        ) {
            return false;
        }

        if (
            offreSansReduction.checked &&
            prod.reduction !== false
        ) {
            return false;
        }

        return true;
    });

    afficherVoyages(resultat);
}

const inputs = document.querySelectorAll("input");

inputs.forEach(function (input) {

    input.addEventListener("change", filtrerVoyages);

    input.addEventListener("input", filtrerVoyages);

});


function reserve(id){

    const prod = voyage.find(function(item){
        return item.id === id;
    });
    const iframeReservation =
    document.getElementById("iframe-reservation");
    iframeReservation.innerHTML += `
        <div class="ligne-reservation">
            <p>${prod.destination}</p>
            <p>${prod.classe}</p>
            <p>${prod.prix} MAD</p>
            <button onclick="supprimer(this)">
                Supprimer
            </button>
        </div>
    `;
}
function supprimer(btn){

    btn.parentElement.remove();

}