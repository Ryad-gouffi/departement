// dark and light theme

let sun = document.getElementById("sun");
let moon = document.getElementById("moon");
let body = document.querySelector("body");
let sidemenu = document.getElementById("side-menu");
let container = document.querySelector("main");


function getThemeFromCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        if (cookie.trim().startsWith('theme=')) {
            return cookie.trim().substring('theme='.length);
        }
    }
    return 'dark'; // default is dark
}

function applyTheme(theme) {
    if (theme === 'light') {
        document.body.classList.add('light');
        sidemenu.classList.add("light")
        container.classList.add("light");
    } else {
        document.body.classList.remove('light');
        sidemenu.classList.remove('light');
        container.classList.remove("light");
    }
}

function toggleTheme() {
    const currentTheme = getThemeFromCookie();
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    applyTheme(newTheme);
    document.cookie = "theme=" + newTheme + "; path=/; max-age=" + 60*60*24*365; // Cookie lasts for 1 year
}

document.addEventListener('DOMContentLoaded', () => {
    const theme = getThemeFromCookie();
    applyTheme(theme);
});




sun.addEventListener("click",()=>{
    toggleTheme();
    sun.classList.remove("active");
    moon.classList.add("active");
})
moon.addEventListener("click",()=>{
    toggleTheme();
    moon.classList.remove("active");
    sun.classList.add("active");
})

let chart;
let line;

fetch("php/dataCharts.php?chart=4")
.then(response=>response.json())
.then(data=>{
    let label = data.labels;
    let counts = data.counts;
    const ctx = document.getElementById("lineChart");
    line = new Chart(ctx, {
        type: "line",
        data: {
        labels: label,
        datasets: [{
            label: ' Requests',
            data: counts,
            fill:false,
            borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allow the chart to grow larger
            scales: {
                x: {
                    type: 'time', // If using time-based data
                    time: {
                        unit: 'day' // Change this to 'week', 'month', etc., as needed
                    },
                    ticks: {
                        autoSkip: true, // Automatically skip ticks for better readability
                        maxTicksLimit: 10 // Set a maximum number of ticks
                    }
                },
                y: {
                    beginAtZero: true, // Always start at zero
                    suggestedMin: 0, // Suggested minimum value
                    suggestedMax: Math.max(...counts) + 10, // Extend max value by 10
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
})




fetchCreateChart("myChart",1,"pie");

// destroy char and make button active
let buttons = document.querySelectorAll("main .chartscontainer .pie .charts .chart-btns button");
function destroyChart(btn){
    buttons.forEach(button=>{
        if(button.classList.contains("active")){
            button.classList.remove("active");
        }
    })
    btn.classList.add("active");
    chart.destroy();
}


function createChart(id,type,label,data){
    const ctx = document.getElementById(id);
    chart = new Chart(ctx, {
        type: type,
        data: {
        labels: label,
        datasets: [{
            label: ' Requests',
            data: data,
            fill:true,
            borderWidth: 1,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
}

function fetchCreateChart(id,chart,type){
    fetch("php/dataCharts.php?chart="+chart.toString())
    .then(response=>response.json())
    .then(data=>{
        let label = data.labels;
        let counts = data.counts;
        createChart(id,type,label,counts);
    })
}


