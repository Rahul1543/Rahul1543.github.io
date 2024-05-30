const inputcity=document.querySelector('.input');
const searchbtn=document.querySelector('.searchbtn');
const weatherimg=document.querySelector('.wimg');
const temperature=document.querySelector('.celcius');
const daydes=document.querySelector('.dtype');
const humidity=document.querySelector('#hname');
const windspeed=document.querySelector('#wname');
const visible=document.querySelector('#vname');
const sunrise=document.querySelector('#srname');
const sunset=document.querySelector('#ssname')

const locationNotFound=document.querySelector('.location_not');
const weatherBody=document.querySelector('.weather');
const extra=document.querySelector('.extra');
const vclass=document.querySelector('.visible');
const sun=document.querySelector('.sun')
const foot=document.querySelector('.footer');




searchbtn.addEventListener('click',()=> {
    checkweather(inputcity.value);
});

async function checkweather(city){
    const api_key="938d27b1432f54dc64955db4ffa39993";
    const url=`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${api_key}`;
    const weatherdata= await fetch(`${url}`).then(response => response.json());

    if(weatherdata.cod === `404`){
        locationNotFound.style.display="flex";
        weatherBody.style.display="none";
        extra.style.display="none";
        vclass.style.display="none";
        sun.style.display="none";
        foot.innerHTML="Please do enter correct city name."
        return;
    }

    locationNotFound.style.display="none";
    weatherBody.style.display="flex";
    extra.style.display="flex";
    vclass.style.display="flex";
    sun.style.display="flex";
    foot.innerHTML="Enjoy your day !!!!"
    temperature.innerHTML=`${Math.round(weatherdata.main.temp -273.15)}°C`;
    daydes.innerHTML=`${weatherdata.weather[0].description}`;
    humidity.innerHTML=`${weatherdata.main.humidity} %`;
    windspeed.innerHTML=`${weatherdata.wind.speed} Km/h`;
    visible.innerHTML=`${weatherdata.visibility} meters`;
    sunrise.innerHTML=`${new Date(weatherdata.sys.sunrise * 1000).toLocaleTimeString()}`;
    sunset.innerHTML=`${new Date(weatherdata.sys.sunset * 1000).toLocaleTimeString()}`;


    switch(weatherdata.weather[0].main){
        case 'Clouds':
            weatherimg.src= "/weather/images/cloud.png";
            break;
        case 'Clear':
            weatherimg.src= "/weather/images/clear.png";
            break;
        case 'Rain':
            weatherimg.src= "/weather/images/rain.png";
            break;
        case 'Mist':
            weatherimg.src= "/weather/images/mist.png";
            break;
        case 'Snow':
            weatherimg.src= "/weather/images/snow.png";
            break;
        case 'Haze':
            weatherimg.src= "/weather/images/haze.png";
            break;
    }


    console.log(weatherdata);

};
