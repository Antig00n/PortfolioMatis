async function getPokemon(pokemonId) {
    const url = `https://pokeapi.co/api/v2/pokemon/${pokemonId}`;
    const response = await fetch(url);
    if (response.ok) {
        const data = await response.json();
        return {
            name: data.name.charAt(0).toUpperCase() + data.name.slice(1),
            image: data.sprites.front_default
        };
    }
    return null;
}

async function generateTeam() {
    const teamContainer = document.getElementById("team");
    teamContainer.innerHTML = "";
    
    const teamSize = 6;
    const promises = [];
    
    for (let i = 0; i < teamSize; i++) {
        const pokemonId = Math.floor(Math.random() * 898) + 1; // Supports up to Gen 8
        promises.push(getPokemon(pokemonId));
    }
    
    const team = await Promise.all(promises);
    
    team.forEach(pokemon => {
        if (pokemon) {
            const pokemonDiv = document.createElement("div");
            pokemonDiv.classList.add("pokemon");
            pokemonDiv.innerHTML = `<p>${pokemon.name}</p><img src="${pokemon.image}" alt="${pokemon.name}">`;
            teamContainer.appendChild(pokemonDiv);
        }
    });
}