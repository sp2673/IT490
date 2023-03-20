
const mainContainer = document.querySelector(".main__container");
const headerSelect = document.querySelector("#header_search");
const headerSearchButton = document.querySelector(".header_button");
const headerSearch = document.getElementById("header_button");
const headerInput = document.getElementById("header_search");
const loader = document.querySelector(".loader")
const mainHeader = document.querySelector(".main_header_container")
const reviews = document.querySelector(".reviews")
const bettingButton = document.querySelector(".button_2");
const team1Input = document.querySelector(".team1")
const team2Input = document.querySelector(".team2")
const title = document.querySelector(".title")
const label1 = document.querySelector(".label1")
const label2 = document.querySelector(".label2");
const titleVenue = document.querySelector(".title")
const finalWinner = document.querySelector(".winner")

//global variables
let date;
let searchingProducts;
let team1;
let team2;
let winner;


//function
const insertingDiv = function(venue,team1,team2){

	reviews.style.opacity= 1;
	 titleVenue.textContent = `staduim: ${venue}`;
	 label1.textContent = `home: ${team1}`;
	 label2.textContent = `away: ${team2}`;

}

const bettingReslove = function(winner){
	mainHeader.style.opacity = 0;
	reviews.style.opacity = 0;
	finalWinner.style.opacity = 1;
	const randomWinner =  Math.floor(Math.random() * 2)+1;
	const moneyBack = winner * 3;
	console.log(randomWinner)
	if(randomWinner === 1){
		finalWinner.textContent = `you won  $${moneyBack}, congratulations`
		// window.location.href = ""
	}else{
		finalWinner.textContent= `you lost your money, Sorry!`
		// window.location.href = ""
	}
	setTimeout(function(){
		window.location.href= "http://127.0.0.1:5500/GOD_PLEASE_searching/index.html";
	},3000)
}


// event handlers

headerSelect.addEventListener("change", function(e){
    date = e.target.value;
})

headerSearchButton.addEventListener("click",function(e){
		const options = {
			method: 'GET',
			headers: {
				'X-RapidAPI-Key': '4e1d363461msh0665420074be6f9p152bc4jsn606648bf172f',
				'X-RapidAPI-Host': 'cricket-live-data.p.rapidapi.com'
			}
		};

		fetch(`https://cricket-live-data.p.rapidapi.com/fixtures-by-date/${date}`, options)
			.then(response => response.json())
			.then(function(response){
				console.log(response)
				console.log(response.results[0].away.name)
				insertingDiv(response.results[0].venue,response.results[0].home.name, response.results[1].away.name)
			})
			.catch(err => console.error(err));

})

bettingButton.addEventListener("click", function(e){
	team1 =team1Input.value;
	team2 = team2Input.value;
	if(team1 > 0 && team2 >0 ) alert("please choose a team not both")
	else if(team1 > 0){
		winner = team1
	}else if(team2 > 0){
		winner = team2
	}else{
		alert("Please choose one team")
	}
	bettingReslove(winner)

})

