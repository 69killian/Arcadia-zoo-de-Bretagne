// Variable globale pour suivre l'état de la fiche (ouverte ou fermée)
let isDetailsVisible = false;

// Sélectionne tous les éléments article dans la colonne-habitat
const articles = document.querySelectorAll('.colonne-habitat article');

// Boucle qui parcours tous les articles
articles.forEach(article => {
    const image = article.querySelector('.habitat-présentation-image');
    const details = article.querySelectorAll('h4');
    const nomAnimal = article.querySelector('h2').textContent.trim(); // Récupère le nom de l'animal

    // Cache les détails de chaque animal par défaut
    details.forEach(detail => {
        detail.style.display = 'none';
    });

    // Au click de l'image
    image.addEventListener('click', () => {
        // Si les détails sont visibles, les cachez, sinon, affichez-les
        details.forEach(detail => {
            detail.style.display = isDetailsVisible ? 'none' : 'block';
        });

        // Inverse l'état de la fiche
        isDetailsVisible = !isDetailsVisible;

        // Si on clique une premiere fois, incrémente les visites
        if (isDetailsVisible) {
            // Envoie une requête AJAX au serveur PHP
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'incremente-visites.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Affiche la réponse du serveur dans la console
                    console.log(xhr.responseText);
                }
            };
            // Envoie les données du formulaire (nom de l'animal)
            xhr.send('nom_animal=' + nomAnimal);
        }
    });
});
