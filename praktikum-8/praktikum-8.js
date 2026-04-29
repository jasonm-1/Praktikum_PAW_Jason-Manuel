function updateDashboard() {
    const body = document.getElementById('bodyTag');
    const greetingElement = document.getElementById('greeting');
    const clockElement = document.getElementById('clock');
    
    const now = new Date();
    const h = now.getHours();
    const m = now.getMinutes();
    const s = now.getSeconds();

    const timeString = [h, m, s].map(v => v.toString().padStart(2, '0')).join(':');
    clockElement.innerText = timeString;

    const currentTime = (h * 100) + m;
    let message = "";
    let theme = "";

    if (currentTime >= 1 && currentTime <= 1059) {
        message = "SELAMAT PAGI";
        theme = "morning";
    } else if (currentTime >= 1100 && currentTime <= 1359) {
        message = "SELAMAT SIANG";
        theme = "noon";
    } else if (currentTime >= 1400 && currentTime <= 1759) {
        message = "SELAMAT SORE";
        theme = "afternoon";
    } else {
        message = "SELAMAT PETANG";
        theme = "night";
    }

    greetingElement.innerText = message;

    if (body.className !== theme) {
        body.className = theme;
    }
}

setInterval(updateDashboard, 1000);
updateDashboard();
