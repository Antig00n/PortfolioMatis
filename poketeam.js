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
    const placeholders = Array(teamSize).fill(`
        <div class="pokemon">
            <p>Loading...</p>
            <img src="placeholder.png" alt="Loading">
        </div>
    `);
    teamContainer.innerHTML = placeholders.join("");

    const promises = [];
    for (let i = 0; i < teamSize; i++) {
        const pokemonId = Math.floor(Math.random() * 898) + 1;
        promises.push(getPokemon(pokemonId));
    }

    const team = await Promise.all(promises);
    team.forEach((pokemon, index) => {
        if (pokemon) {
            const pokemonDivs = document.querySelectorAll(".pokemon");
            pokemonDivs[index].innerHTML = `<p>${pokemon.name}</p><img src="${pokemon.image}" alt="${pokemon.name}">`;
        }
    });
}