
//queryselectors
const mainContainer = document.querySelector(".main__container");
const headerSelect = document.querySelector(".select");
const headerSearchButton = document.querySelector(".header_button");
const headerSearch = document.getElementById("header_button");
const headerInput = document.getElementById("header_search");
const loader = document.querySelector(".loader")
const mainHeader = document.querySelector(".main_header_container")
const reviews = document.querySelector(".reviews")



//global variables

let choosingOne;
let clicked = 0;
let userInput;




//functions

const insertingDivPlayer = function(image, birthplace, bat,bio ){
    const html = `<div class="review">
				<img src="${image}" alt="player image" class="player_image">
                <div class="birth"><span> birthplace</span><br> ${birthplace} </div>
				<div class="bat"><span> bat status</span><br>  ${bat} </div>
                <div class="bio"><span> player bio</span><br>  ${bio} </div>


                </div>`;
    reviews.insertAdjacentHTML("beforeend", html)
}


const insertingCountry = function(country ,news1, news2, news3){
    const html = `<div class="review">
			<h1><div class="context">Stats and News: ${country} </div></h1>

				<h2><div class="context">title: ${news1.story.context} </div></h2>
				<div class="title">title: ${news1.story.hline} </div>
                <div class="news"><span>  ${news1.story.intro} </div>

				<div class="title">title: ${news2.story.hline} </div>
                <div class="news"><span>${news2.story.intro} </div>
				
				<div class="title">title: ${news3.story.hline} </div>
                <div class="news"><span> ${news3.story.intro} </div>


                </div>`;
    reviews.insertAdjacentHTML("beforeend", html)
}



const findingSpace = function(word){
	const wordArray = word.split("");
	const indexNumber = wordArray.findIndex(function(value){
		return value == " ";
	})
	if(indexNumber > 0){
		const country = word.charAt(0).toUpperCase() + word.slice(1,indexNumber) + " " + word.charAt(indexNumber+1).toUpperCase() + word.slice((indexNumber+2));
		return country
	}else{
		const countrys = word.charAt(0).toUpperCase() + word.slice(1);
		return countrys;

	}
}



//event handlers


headerSelect.addEventListener("change", function(e){
	if(!e.target.value) return;
    choosingOne = e.target.value;
})



headerSearchButton.addEventListener("click",function(e){
	e.preventDefault()
	if(!choosingOne) alert("Please choose of the following countries or players from the drop down");
	userInput = headerInput.value;
	console.log(clicked)
	if(clicked > 0){
        while(reviews.firstChild) reviews.removeChild(reviews.firstChild)
    }
	clicked++;
    
	if(choosingOne === "countries"){
	
		const option = {
			method: 'GET',
			headers: {
				'X-RapidAPI-Key': '307f8a199emshfb36c51e04d14b5p1dfb2ejsn0461b1bb7dbb',
				'X-RapidAPI-Host': 'unofficial-cricbuzz.p.rapidapi.com'
			}
		};

		fetch('https://unofficial-cricbuzz.p.rapidapi.com/teams/list?matchType=international', option)
			.then(response => response.json())
			.then(function(response){
				console.log(response)
				let teamsId = 0;
				const responseData = response.teamData;
				console.log(responseData)
				for(let i = 1; i < responseData.length; i++){
					if(responseData[i].teamName === findingSpace(userInput)){
						teamsId = responseData[i].teamId;
					}	
				}
				console.log(teamsId)
				fetch(`https://unofficial-cricbuzz.p.rapidapi.com/teams/get-news?teamId=${teamsId}`, option)
					.then(response => response.json())
					.then(function(response){
						console.log(response)
						const responseData = response.newsList;
					 	insertingCountry(response.appIndex.seoTitle ,responseData[0], responseData[2], responseData[7])

					})
					.catch(err => console.error(err));	
			})
			.catch(err => console.error(err));


	}else if(choosingOne === "players"){
		const fullName = userInput.toLowerCase().split(" ");
		const options = {
			method: 'GET',
			headers: {
				'X-RapidAPI-Key': '4e1d363461msh0665420074be6f9p152bc4jsn606648bf172f',
				'X-RapidAPI-Host': 'cricbuzz-cricket.p.rapidapi.com'
			}
		};


		fetch(`https://cricbuzz-cricket.p.rapidapi.com/stats/v1/player/search?plrN=${fullName[0]}_${fullName[1]}`, options)
			.then(response => response.json())
			.then(function(response){

		        const [responsed] = response.player
		        fetch(`https://cricbuzz-cricket.p.rapidapi.com/stats/v1/player/${responsed.id}`, options)
		        .then(response => response.json())
		        .then(function(response){

					insertingDivPlayer(response.image, response.birthPlace, response.bat, response.bio)
				})
		    })
			.catch(err => console.error(err));

	}
})

















//teams search

// const options = {
// 	method: 'GET',
// 	headers: {
// 		'X-RapidAPI-Key': '307f8a199emshfb36c51e04d14b5p1dfb2ejsn0461b1bb7dbb',
// 		'X-RapidAPI-Host': 'cricbuzz-cricket.p.rapidapi.com'
// 	}
// };


// fetch(`https://cricbuzz-cricket.p.rapidapi.com/stats/v1/player/search?plrN=${first_name_of_the_player}_${lastname}`, options)
// 	.then(response => response.json())
// 	.then(function(response){
//         const [responsed] = response.player
//         // console.log(responsed.id)
//         fetch(`https://cricbuzz-cricket.p.rapidapi.com/stats/v1/player/${responsed.id}`, options)
//         .then(response => response.json())
//         .then(response => console.log(response))
//     })
// 	.catch(err => console.error(err));







//searching countires 


// const option = {
// 	method: 'GET',
// 	headers: {
// 		'X-RapidAPI-Key': '307f8a199emshfb36c51e04d14b5p1dfb2ejsn0461b1bb7dbb',
// 		'X-RapidAPI-Host': 'unofficial-cricbuzz.p.rapidapi.com'
// 	}
// };

// fetch('https://unofficial-cricbuzz.p.rapidapi.com/teams/list?matchType=international', option)
// 	.then(response => response.json())
// 	.then(function(response){
// 		let teamsId = 0;
// 		const responseData = response.teamData;
// 		for(let i = 1; i < responseData.length; i++){
// 			if(responseData[i].teamName === "here whent the user put there input"){
// 				teamsId = responseData[i].teamId;
// 			}	
// 		}
// 		console.log(teamsId)
// 		fetch(`https://unofficial-cricbuzz.p.rapidapi.com/teams/get-news?teamId=${teamsId}`, option)
// 			.then(response => response.json())
// 			.then(response => console.log(response))
// 			.catch(err => console.error(err));	
// 	})
// 	.catch(err => console.error(err));



