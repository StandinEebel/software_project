fetch("https://www.thecocktaildb.com/api/json/v1/1/random.php").then((response) => {
    if (response.ok) {
        return response.json();
    } else {
        throw new Error("Network response error");
    }
}).then(data => {
    console.log(data);
    displayCocktail(data)
}).catch((error) => console.error("Fetch error: ", error));

function displayCocktail(data) {
    const cocktail = data.drinks[0];
    const cocktailDiv = document.getElementById("cocktail");

    //cocktail name
    const cocktailName = cocktail.strDrink;
    const heading = document.createElement("h1");
    heading.innerHTML = cocktailName;
    cocktailDiv.appendChild(heading);

    //cocktail image
    const cocktailImg = document.createElement("img");
    cocktailImg.src = cocktail.strDrinkThumb;
    cocktailDiv.appendChild(cocktailImg);
    document.body.style.backgroundImage = "url('" + cocktail.strDrinkThumb + "')";
   
    //cocktail ingredient
    const cocktailIngredients = document.createElement("ul");
    cocktailDiv.appendChild(cocktailIngredients);
    const getIngredients = Object.keys(cocktail).filter(function(ingredient) {
        return ingredient.indexOf("strIngredient") == 0;
    }).reduce(function(ingredient, ingredient) {
        if (cocktail[ingredient] != null) {
            ingredient[ingredient] = cocktail[ingredient];
        }
        return ingredient;
    }, {});
}
