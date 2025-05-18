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
    return null; }


async function generateTeam() {
    const pokemonDivs = document.querySelectorAll(".pokemon");

    const promises = [];
    for (let i = 0; i < pokemonDivs.length; i++) {
        const pokemonId = Math.floor(Math.random() * 898) + 1;
        promises.push(getPokemon(pokemonId));
    }



    const team = await Promise.all(promises);
    team.forEach((pokemon, index) => {
        if (pokemon) {
            pokemonDivs[index].innerHTML = `<p>${pokemon.name}</p><img src="${pokemon.image}" alt="${pokemon.name}">`;
        }
    }); }