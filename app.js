function onPageLoad() {
    // get display name n that
    const DATA_PROFILE = JSON.parse(localStorage.getItem("DATA_PROFILE"));
    document.getElementById("display-name").innerText = DATA_PROFILE.display_name;
    optionChange();
}

function displayData(num, term) {
    if(num == 10 && term == 'short') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP10_TRACKS_short_term"));
        document.getElementById("limit").innerText = "Top 10";
        document.getElementById("time_range").innerText = "4 Weeks";
    } else if(num == 10 && term == 'medium') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP10_TRACKS_medium_term"));
        document.getElementById("limit").innerText = "Top 10";
        document.getElementById("time_range").innerText = "6 Months";
    } else if(num == 10 && term == 'long') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP10_TRACKS_long_term"));
        document.getElementById("limit").innerText = "Top 10";
        document.getElementById("time_range").innerText = "All Time";
    } else if(num == 50 && term == 'short') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP50_TRACKS_short_term"));
        document.getElementById("limit").innerText = "Top 50";
        document.getElementById("time_range").innerText = "4 Weeks";
    } else if(num == 50 && term == 'medium') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP50_TRACKS_medium_term"));
        document.getElementById("limit").innerText = "Top 50";
        document.getElementById("time_range").innerText = "6 Months";
    } else if(num == 50 && term == 'long') {
        var data = JSON.parse(localStorage.getItem("DATA_TOP50_TRACKS_long_term"));
        document.getElementById("limit").innerText = "Top 50";
        document.getElementById("time_range").innerText = "All Time";
    } else {
        console.error("Invalid Arguments");
        return 0;
    }

    document.getElementById("dms-list").innerHTML = '';



    let rank = 1;
    for(item in data['items']) {
        let profile_img_url = data['items'][item]['album']['images']['2'].url;
        let artist = data['items'][item]['artists']['0'].name;
        let song = data['items'][item].name;

        let dm = document.createElement("li");
        dm.setAttribute("class", "dm");
        let dmContent = `
        <div class="left">
            <div class="profile-photo">
                <img class="profile-img" id="profile-image" src="${profile_img_url}">
            </div>
            <div class="message">
                <p class="artist" id="artist">${artist}</p>
                <p><span class="song" id="song">${song}</span><span class="rank">&nbsp;⋅&nbsp;${rank}h</span></p>
            </div>
        </div>
        <div class="right">
            <img src="assets/camera-white.svg">
        </div>
        `;

        dm.innerHTML = dmContent;
        document.getElementById("dms-list").appendChild(dm);
        rank += 1;
    }   
}


function optionChange() {
    let params = new URLSearchParams(document.location.search);
    let time_range = params.get("time_range");
    let amount = parseInt(params.get("amount"));
    console.log(time_range, amount);
    // let time_range = document.getElementById("time_range_selector").value;
    // let amount = document.getElementById("amount_selector").value;
    displayData(amount, time_range);
}