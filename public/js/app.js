// cf. https://www.youtube.com/watch?v=f7tdb30evUk
window.onload = () => 
{
	/* --------------------------------------------------------
	* Recherche d'une ville par son code postal
	* Affichage des villes dans un select indépendant du champ
	* dans lequel on cherche le code postal
	* ---------------------------------------------------------
	*/
	if (window.location.href.substr(-12) == "geocode2/new") {
		
		// Cible le champ de formulaire 
		// /!\ Symfony préfixe l'id des input avec le nom de l'entité; ici 'geocode2_' 
		let oCodePostal = document.getElementById("geocode2_codepostal");

		// Exécution de la fonction searchCities() dès la fin de la saisie d'une lettre
		oCodePostal.addEventListener("keyup", searchCitiesByPc);

		// console.log(oCodePostal);

		function searchCitiesByPc() {	
			// Récupère la valeur du champ (dès la fin de la saisie d'une lettre) 
			let sValeur = oCodePostal.value;
			
			// Quand il y a 5 chiffres (code postal saisi entièrement)
			if (sValeur.length == 5) 
			{
				// console.log("valeur : "+sValeur);
				
				// Interrogation de l'API Géocode
				// L'url doit être : https://geo.api.gouv.fr/communes?codePostal=80000&fields=nom
				// Dans cette url, il nous faut remplacer '80000' par la valeur saisie dans notre champ geocode2_code
				// const sApiGeoUrl = "https://geo.api.gouv.fr/communes?codePostal="+sValeur+"&fields=nom";
				const sApiGeoUrl = "https://geo.api.gouv.fr/communes?codePostal="+sValeur+"&fields=nom";

				// On interroge l'API avec fetch :
				fetch(sApiGeoUrl,
					  { method: 'get' })
				.then(response => response.json())
				.then(
						results => 
							{ 
								console.log(results);
								
								// Affichage des résultats 
								if (results.length) { // On teste s'il y a des résultats
															
									let sHtml = '';
									
									// On boucle sur les résultats
									results.forEach((value) => {	
										console.log(value);
															
										// On construit les options de la datalist HTML
										sHtml += "<option value='"+value.nom+"'>"+value.nom+"</option>\n";	
										});
										
										// console.log(sHtmlDatalist);
									document.getElementById("geocode2_ville").innerHTML = sHtml; 									
								} else {
									console.log("Aucun résultat.");
									// +++ TODO : afficher un message HTML +++  
								}						
							}
					)
				// Erreur dans la réponse de l'API 	
				.catch(error => { 
					console.log(error);
					// +++ TODO : afficher un message HTML +++  	
					});		       		
			}	
		} // -- searchCities()
	}
	
	
	
} // -- window.onload