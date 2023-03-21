const newsTitle = document.querySelector(".title");
const newsBody = document.querySelector(".news__body")


const option = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '4e1d363461msh0665420074be6f9p152bc4jsn606648bf172f',
		'X-RapidAPI-Host': 'cricbuzz-cricket.p.rapidapi.com'
	}
};

fetch('https://cricbuzz-cricket.p.rapidapi.com/news/v1/detail/122025', option)
	.then(response => response.json())
	.then(function(response){
        console.log(response)
        const headline = response.headline;
        console.log(headline)
        const responseContent = response.content;
        newsTitle.innerHTML= headline;
        console.log(responseContent)
        console.log(responseContent[0]) 
        for(let i = 0; i < 6; i++){
            console.log(responseContent[i].content.contentValue)
            const html = `<div> ${responseContent[i].content.contentValue} </div>`
            newsBody.insertAdjacentHTML("beforeend", html)
        }
        
        
    })
	.catch(err => console.error(err));
const options = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '4e1d363461msh0665420074be6f9p152bc4jsn606648bf172f',
		'X-RapidAPI-Host': 'cricbuzz-cricket.p.rapidapi.com'
	}
};

fetch('https://cricbuzz-cricket.p.rapidapi.com/img/v1/i1/c231889/i.jpg', options)
	.then(function(response){
        const html1 = `    <img src="${response.url}" alt="" style="display:  flex; align-items: center;justify-content: center; width: 200px; height: 200px;">`
        newsBody.insertAdjacentHTML("afterbegin", html1)
    })

	.catch(err => console.error(err));